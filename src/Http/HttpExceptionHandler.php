<?php

namespace heinthanth\bare\Http;

use League\Route\Http\Exception;
use Monolog\Logger;
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
     * Logger instance
     * @var \Monolog\Logger
     */
    protected Logger $logger;

    /**
     * Get throwable
     */
    public function __construct(Throwable $exception, Logger $logger)
    {
        $this->exception = $exception;
        $this->logger = $logger;
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
        $this->logger->error($this->exception);
        return $this->handle();
    }
}
