<?php

namespace App\Models\ProductsTypes;

use Exception;
use App\Models\ProductsModel;
use App\Models\ProductsInterface;

class DVD extends ProductsModel implements ProductsInterface
{
    public function makeDescription($values): string
    {
        $size = $values['size'];

        if (!isset($size) || $size === ''  || $size < 0) {
            throw new Exception('Size is required and must be a positive number');
        }

        return "Size: {$size} MB";
    }
}
