<?php

namespace heinthanth\bare\Strategies;

use heinthanth\bare\Http\ExceptionHandler;
use heinthanth\bare\Http\RequestHandlerMiddleware;
use League\Route\Http\Exception\MethodNotAllowedException;
use League\Route\Http\Exception\NotFoundException;
use League\Route\Route;
use League\Route\Strategy\ApplicationStrategy;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Throwable;

class Application extends ApplicationStrategy
{
    public function invokeRouteCallable(Route $route, ServerRequestInterface $request): ResponseInterface
    {
        try {
            $controller = $route->getCallable($this->getContainer());
        } catch (Throwable $exception) {
            return $this->getHttpExceptionHandler($exception)->handle();
        }
        $response = $controller($request, $route->getVars());

        $response = $this->applyDefaultResponseHeaders($response);
        return $response;
    }

    public function getNotFoundDecorator(NotFoundException $exception): MiddlewareInterface
    {
        return $this->getHttpExceptionHandler($exception);
    }

    public function getMethodNotAllowedDecorator(MethodNotAllowedException $exception): MiddlewareInterface
    {
        return $this->getHttpExceptionHandler($exception);
    }

    public function getHttpExceptionHandler(Throwable $exception)
    {
        return new ExceptionHandler($exception);
    }

    public function getExceptionHandler(): MiddlewareInterface
    {
        return new RequestHandlerMiddleware();
    }
}
