<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Controllers\Controller;

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

    public function create(): string
    {
        $data = (array) json_decode(file_get_contents("php://input"), true);

        $this->gateway->setSku($data['sku']);
        $this->gateway->setName($data['name']);
        $this->gateway->setPrice($data['price']);
        $this->gateway->setAttribute($data['attribute']);

        $status = $this->gateway->create();

        if ($status) {
            http_response_code(201);
            return "Product {$this->gateway->getSku()} Added Successfully";
        } else {
            http_response_code(400);
            return "Error Adding Product {$this->gateway->getSku()}";
        }
    }

    public function delete(): string
    {
        $data = (array) json_decode(file_get_contents("php://input"), true);

        $this->gateway->setIds($data["ids"]);

        $status = $this->gateway->delete();

        if ($status) {
            http_response_code(200);
            return "Product {$this->gateway->getIds()} Deleted Successfully";
        } else {
            http_response_code(400);
            return "Error Deleting Product {$this->gateway->getIds()}";
        }

        return $status;
    }
}
