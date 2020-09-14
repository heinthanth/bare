<?php

use heinthanth\bare\Routing\Route;

$route = new Route;

$route->get('/', function () {
    echo "Hello, World!";
});

$route->get('/post/{d:\d+}', function () {
    echo "Hello, Post works!";
});

return $route;
