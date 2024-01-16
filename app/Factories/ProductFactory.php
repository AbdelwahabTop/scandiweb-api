<?php

// Based on feedback from the previous task, to differentiates product types i used this factory pattern.

declare(strict_types=1);

namespace App\Factories;

use App\Models\ProductsModel;
use App\Models\ProductsInterface;

class ProductFactory
{
    public static function create(string $type): ProductsInterface & ProductsModel
    {
        $productClass = "App\\Models\\ProductsTypes\\" . ucfirst($type);

        if (!class_exists($productClass)) {
            throw new \Exception("Product type {$type} does not exist");
        }

        return new $productClass();
    }
}
