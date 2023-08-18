<?php

namespace App\Controllers;

abstract class Controller
{

    public function model($model)
    {
        $class = "App\Models\\" . $model;

        return new $class();
    }
}
