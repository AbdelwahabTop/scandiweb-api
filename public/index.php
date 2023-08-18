<?php

declare(strict_types = 1);

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, DELETE");
header("Content-type: application/json; charset: UTF-8");

use App\App;
use App\Router;
use App\Database\Config;
use App\Controllers\ProductController;

$router = new Router();

$router
    ->get('/products', [ProductController::class, 'getAll'])
    ->post('/products', [ProductController::class, 'create'])
    ->delete('/products', [ProductController::class, 'delete']);
    
(new App(
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    new Config($_ENV)
))->run();


