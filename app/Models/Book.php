<?php

namespace App\Models;

class Book extends ProductsModel implements ProductsInterface
{
    public function description(array $values): string
    {
        return "Weight: {$values['weight']} kg";
    }
}
