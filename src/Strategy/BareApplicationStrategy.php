<?php

namespace heinthanth\bare\Strategy;

use heinthanth\bare\Handler\ExceptionResponseHandler;
use heinthanth\bare\Handler\HttpErrorResponseHandler;
use League\Route\Http\Exception\MethodNotAllowedException;
use League\Route\Http\Exception\NotFoundException;
use League\Route\Strategy\ApplicationStrategy;
use Psr\Http\Server\MiddlewareInterface;

class BareApplicationStrategy extends ApplicationStrategy
{
    public function getNotFoundDecorator(NotFoundException $exception): MiddlewareInterface
    {
        return new HttpErrorResponseHandler($exception);
    }

    public function getMethodNotAllowedDecorator(MethodNotAllowedException $exception): MiddlewareInterface
    {
        return new HttpErrorResponseHandler($exception);
    }

    public function getExceptionHandler(): MiddlewareInterface
    {
        return new ExceptionResponseHandler();
    }
}
