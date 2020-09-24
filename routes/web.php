<?php

use League\Route\Router;

$router = new Router();

$router->get('/', function () {
    return view('welcome');
});

return $router;
