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
        /* if you now dublicate the App class and take more than one instance from db all these instance will
        be equal to each others
        $db1 = App::db();
        $db2 = App::db();
        $db3 = App::db();
        ($db1 == db2 == db3) //true */
        $this->db = App::db();
    }

    abstract protected function get();
    abstract protected function create();
    abstract protected function delete();
}
