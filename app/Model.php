<?php

declare(strict_types=1);

namespace App;

use App\DB;
use App\App;

abstract class Model
{
    protected DB $db;

    public function __construct()
    {
        $this->db = App::db();
    }

    abstract protected function getProducts();
    abstract protected function create();
    abstract protected function delete();
}