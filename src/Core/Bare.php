<?php

namespace heinthanth\bare\Core;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Http\Exception;
use League\Route\Http\Exception\HttpExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use League\Route\Router;

class Bare
{
    public function handle(ServerRequestInterface $request, Router $router)
    {
        try {
            $response = $router->dispatch($request);
        } catch (HttpExceptionInterface $e) {
            $response = $this->handleRouteException($e);
        }

        $emitter = new SapiEmitter();
        $emitter->emit($response);
    }

    private function handleRouteException(Exception $e): ResponseInterface
    {
        return new HtmlResponse("<h1>{$e->getStatusCode()}</h1><p>{$e->getMessage()}</p>");
    }
}
