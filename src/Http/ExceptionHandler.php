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
     * @
     */
    protected ?\Throwable $exception;

    /**
     * define templates.
     * @var array
     */
    protected array $templates = [
        403, 404, 405, 500
    ];

    public function __construct(?Throwable $exception = null)
    {
        $this->exception = $exception;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $e = $this->exception;
        if ($e instanceof \League\Route\Http\Exception) {
            # if template exists, return that template.
            if (in_array($e->getStatusCode(), $this->templates)) return view('__builtin::errors/' . $e->getStatusCode(), [], $e->getStatusCode());

            # or use generate template
            return view('__builtin::errors/generic', [
                'code' => $e->getStatusCode(),
                'desc' => $e->getMessage()
            ]);
        } else {
            if (env('APP_ENVIRONMENT', 'development') === 'production') {
                return view('__builtin::errors/500', [], 500);
            } else {
                throw $e;
            }
        }
    }
}
