<?php

namespace App\Factories;

class ProductFactory
{
    public static function create(string $type)
    {
        $productClass = "App\\Models\\" . ucfirst($type);
        var_dump($productClass);

        if (!class_exists($productClass)) {
            throw new \Exception("Product type {$type} does not exist");
        }

        return new $productClass();
    }
}