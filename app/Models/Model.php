<?php

// this model is the parent of all models that provides the database connection insteade of each model having to create its own connection

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
}
