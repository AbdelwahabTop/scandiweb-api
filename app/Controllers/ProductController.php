<?php

namespace App\Controllers;

use App\Controller;
use App\Models\ProductsModel;

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
        var_dump($data);

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
        var_dump($data);
        $this->gateway->ids = $data["ids"];
        $status = $this->gateway->delete();
        return $status;
    }
}
