<?php

namespace App\Models\ProductsTypes;

use Exception;
use App\Models\ProductsModel;
use App\Models\ProductsInterface;

class Book extends ProductsModel implements ProductsInterface
{
    public function makeDescription(array $values): string
    {
        $weight = $values['weight'];

        if (!isset($weight) || $weight === ''  || $weight < 0) {
            throw new Exception('Weight is required and must be a positive number');
        }

        return "Weight: {$weight} kg";
    }
}
