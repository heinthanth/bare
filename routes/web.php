<?php

use App\Http\Controllers\DemoController;
use League\Route\Http\Exception\ForbiddenException;
use League\Route\Router;

$router = new Router();

$router->get('/', function () {
    return view('welcome');
});
$router->post('/wrong-method', function () {
    # won't execute
});
$router->get('/secret', function () {
    throw new ForbiddenException();
});
$router->get('/wrong-controller', [NotExists::class, 'index']);
$router->get('/wrong-controller-method', [DemoController::class, 'notExist']);

return $router;
