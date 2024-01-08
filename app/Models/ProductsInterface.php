<?php

namespace App\Models;

use App\Models\Model;

interface ProductsInterface {
    public function description(array $values): string;
}
