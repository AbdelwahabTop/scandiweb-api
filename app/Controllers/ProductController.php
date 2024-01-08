<?php

namespace App\Controllers;

use App\Models\DVD;
use App\Models\Book;
use App\Models\Furniture;
use App\Models\ProductsModel;
use App\Controllers\Controller;
use App\Factories\ProductFactory;

class ProductController extends Controller
{
    private ProductsModel $gateway;

    public function __construct()
    {
        $this->gateway = $this->model("ProductsModel");
    }

    public function getAll(): string
    {
        return json_encode($this->gateway->get());
    }

    public function create()
    {
        $data = (array) json_decode(file_get_contents("php://input"), true);
        // echo var_dump($data);
        var_dump($data['attributes']);


        $productClass = ProductFactory::create(
            $data['type'],
        );

        try {
            $productClass->setSku($data['sku']);
            $productClass->setName($data['name']);
            $productClass->setPrice($data['price']);
            $description = $productClass->description($data['attributes']);
            $productClass->setAttribute($description);

        } catch (\Exception $e) {
            http_response_code(400);
            return $e->getMessage();
        }

        $status = $productClass->create();

        if ($status) {
            http_response_code(201);
            return "Product {$productClass->getSku()} Added Successfully";
        } else {
            http_response_code(400);
            return "Error Adding Product {$this->gateway->getSku()}";
        }
    }

    public function delete(): string
    {
        $data = (array) json_decode(file_get_contents("php://input"), true);

        try {
            $this->gateway->setIds($data["ids"]);
        } catch (\Exception $e) {
            http_response_code(400);
            return $e->getMessage();
        }

        $status = $this->gateway->delete();

        if ($status) {
            http_response_code(200);
            return "Products Deleted Successfully";
        } else {
            http_response_code(400);
            return "Error Deleting Product";
        }

        return $status;
    }
}
