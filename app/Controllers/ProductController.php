<?php

namespace App\Controllers;

use App\Controller;

class ProductController extends Controller
{
    private $gateway;
    
    public function __construct()
    {
        $this->gateway = $this->model("ProductsGateway");
    }

    public function getAll(): string
    {
        return json_encode($this->gateway->getProducts());
    }

    public function create(): string
    {
        $data = (array) json_decode(file_get_contents("php://input"), true);

        $this->gateway->sku = $data['sku'];
        $this->gateway->name = $data['name'];
        $this->gateway->price = $data['price'];
        $this->gateway->attribute = $data['attribute'];
        $status = $this->gateway->create();
        return $status;
    }

    public function delete(): string
    {
        $data = (array) json_decode(file_get_contents("php://input"), true);
        $this->gateway->ids = $data["ids"];
        $status = $this->gateway->delete();
        return $status;
    }

}