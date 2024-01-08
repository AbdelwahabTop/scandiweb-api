<?php

namespace App\Models;

class DVD extends ProductsModel implements ProductsInterface
{
    public function description($values): string
    {
        return "Size: {$values['size']}MB";
    }
}