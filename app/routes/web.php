<?php

use heinthanth\bare\Routing\Route;

$route = new Route;

$route->get('/', 'PagesController@index');

$route->post('/post/{id:\d+}/delete', function ($param) {
    echo "Get POST data: user => {$_POST['user']}" . PHP_EOL;
    print_r($param);
});

return $route;
