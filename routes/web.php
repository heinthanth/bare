<?php

use Illuminate\Support\Facades\Hash;
use Laminas\Diactoros\Response\HtmlResponse;
use League\Route\Router;

$router = new Router();

$router->get('/', function () {
    return view('welcome');
});

$router->get('/illuminate', function () {
    return new HtmlResponse("Hash => " . Hash::make('Hello, World!'));
});

return $router;
