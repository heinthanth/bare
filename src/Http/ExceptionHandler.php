<?php

namespace heinthanth\bare\Http;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

class ExceptionHandler implements MiddlewareInterface
{
    /**
     * Exception instance
     * @var \Throwable
     */
    protected \Throwable $exception;

    public function __construct(?Throwable $exception)
    {
        $this->exception = $exception;
    }

    public function handle(): ResponseInterface
    {
        $e = $this->exception;
        if ($e instanceof \League\Route\Http\Exception) {
            return view('__builtin::errors/base', [
                'description' => $e->getStatusCode() . ' - ' . $e->getMessage()
            ]);
        } else {
            if (env('APP_ENVIRONMENT', 'development') === 'production') {
                return view('__builtin::errors/base', [
                    'description' => 'Something went wrong ...'
                ], 500);
            } else {
                throw $e;
            }
        }
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $this->handle($this->exception);
    }
}
