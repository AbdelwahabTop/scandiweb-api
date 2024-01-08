<?php

namespace App\Models;

class Furniture extends ProductsModel implements ProductsInterface
{
    public function description($values): string
    {
        return "Dimensions: {$values['height']}x{$values['width']}x{$values['length']}";
    }
}