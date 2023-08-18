<?php

declare(strict_types=1);

namespace App\Models;

use App\App;
use App\Database\DB;

abstract class Model
{
    protected DB $db;

    public function __construct()
    {
        $this->db = App::db();
    }

    abstract protected function get();
    abstract protected function create();
    abstract protected function delete();
}
