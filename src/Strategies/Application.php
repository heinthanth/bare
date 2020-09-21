<?php

namespace heinthanth\bare\Strategies;

use heinthanth\bare\Http\ExceptionHandler;
use heinthanth\bare\Http\RequestHandlerMiddleware;
use League\Route\Http\Exception\MethodNotAllowedException;
use League\Route\Http\Exception\NotFoundException;
use League\Route\Strategy\ApplicationStrategy;
use Psr\Http\Server\MiddlewareInterface;

class Application extends ApplicationStrategy
{
    public function getNotFoundDecorator(NotFoundException $exception): MiddlewareInterface
    {
        return new ExceptionHandler($exception);
    }

    public function getMethodNotAllowedDecorator(MethodNotAllowedException $exception): MiddlewareInterface
    {
        return new ExceptionHandler($exception);
    }

    public function getExceptionHandler(): MiddlewareInterface
    {
        return new RequestHandlerMiddleware();
    }
}
