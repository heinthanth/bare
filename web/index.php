<?php

use heinthanth\bare\Routing\Router;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/config/bootstrap.php';

$router = new Router();

echo $router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
