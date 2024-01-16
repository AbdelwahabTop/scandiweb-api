<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Factories\ProductFactory;
use App\Models\CoreModel;

class ProductController
{
    private CoreModel $coreModel;

    public function __construct()
    {
        $this->coreModel = new CoreModel();
    }

    public function getAll(): string
    {
        return json_encode($this->coreModel->get("products"));
    }

    public function create()
    {
        $data = (array) json_decode(file_get_contents("php://input"), true);

        $productClass = ProductFactory::create(
            $data['type'],
        );

        try {
            $productClass->setSku($data['sku']);
            $productClass->setName($data['name']);
            $productClass->setPrice($data['price']);
            $description = $productClass->makeDescription($data['attributes']);
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
            return "Error Adding Product, Skus must be unique";
        }
    }

    public function delete(): string
    {
        $data = (array) json_decode(file_get_contents("php://input"), true);
        var_dump($data["ids"]);

        try {
            $this->coreModel->setIds($data["ids"]);
        } catch (\Exception $e) {
            http_response_code(400);
            return $e->getMessage();
        }

        $status = $this->coreModel->massDelete("products");

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
