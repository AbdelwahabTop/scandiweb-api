<?php

namespace App\Models\ProductsTypes;

use Exception;
use App\Models\ProductsModel;
use App\Models\ProductsInterface;

class Furniture extends ProductsModel implements ProductsInterface
{
    public function makeDescription($values): string
    {
        $dimensions = ['height', 'width', 'length'];

        foreach ($dimensions as $dimension) {
            if (
                !isset($values[$dimension]) ||
                $values[$dimension] === ''  ||
                $values[$dimension] < 0
            ) {
                throw new Exception(ucfirst($dimension) . ' is required and must be a positive number');
            }
        }

        return "Dimensions: {$values['height']}x{$values['width']}x{$values['length']}";
    }
}
