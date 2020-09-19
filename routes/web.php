<?php

use League\Route\Router;

use function heinthanth\bare\Helper\view;

$router = new Router();

$router->get('/', function() {
    return view('welcome');
});

return $router;
