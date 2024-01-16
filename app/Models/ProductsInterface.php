<?php

// Based on feedback from the previous task, The implementation lacks polymorphism. This interface is implemented by all product types

declare(strict_types=1);

namespace App\Models;

interface ProductsInterface
{
    public function makeDescription(array $values): string;
}
