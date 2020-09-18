<?php

use App\Controllers\PostController;
use App\Middlewares\AdminMiddleware;
use Laminas\Diactoros\Response;
use League\Route\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$router = new Router();

$router->map('GET', '/', function (ServerRequestInterface $request): ResponseInterface {
    return new Response();
});

$router->map('GET', '/post', [PostController::class, 'index']);
$router->map('POST', '/post/{id:number}', [PostController::class, 'update'])->middleware(new AdminMiddleware);

return $router;
