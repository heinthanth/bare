<?php

use App\Http\Controllers\DemoController;
use Laminas\Diactoros\Response\TextResponse;
use League\Route\Http\Exception\ForbiddenException;
use League\Route\Http\Exception\MethodNotAllowedException;
use League\Route\Router;

$router = new Router();

$router->get('/', function () {
    return view('welcome');
});
$router->post('/not-allowed', function () {
    return new TextResponse('You can\'t GET it!');
});
$router->get('/forbidden', function () {
    throw new ForbiddenException();
});
$router->get('/random-exception', function () {
    throw new Exception('Just random exception');
});
$router->get('/wrong-controller', [NotExists::class, 'index']);
$router->get('/wrong-controller-method', [DemoController::class, 'notExists']);
$router->get('/wrong-controller-args', [ DemoController::class, 'test' ]);

return $router;
