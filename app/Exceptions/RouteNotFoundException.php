<?php

namespace App\Exceptions;

class RouteNotFoundException extends \Exception
{
    public function __construct()
    {
        echo $_SERVER['REQUEST_METHOD'];
        echo "Route not found";
    }
    protected $message = '404 Not Found';
}