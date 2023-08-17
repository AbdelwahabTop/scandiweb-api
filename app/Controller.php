<?php

namespace App;

abstract class Controller
{

    public function model($model)
    {
        $class = "App\Models\\" . $model;

        return new $class();
    }
}
