<?php

declare(strict_types=1);

namespace heinthanth\bare\Http;

use League\Route\Http\Exception;
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Psr\Http\Server\{MiddlewareInterface, RequestHandlerInterface};
use Throwable;

class HttpExceptionHandler implements MiddlewareInterface
{
    /**
     * throwable Exception instance
     * @var \Throwable
     */
    protected $exception;

    /**
     * Get throwable
     */
    public function __construct(Throwable $exception)
    {
        $this->exception = $exception;
    }

    public function handle(): ResponseInterface
    {
        if ($this->exception instanceof Exception) {
            return view('__builtin::errors/base', [
                'description' => $this->exception->getStatusCode() . ' - ' . $this->exception->getMessage()
            ]);
        } else {
            if (env('APP_ENVIRONMENT', 'production') === 'development') {
                throw $this->exception;
            } else {
                return view('__builtin::errors/base', [
                    'description' => 'Something went wrong ...'
                ], 500);
            }
        }
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $this->handle();
    }
}
