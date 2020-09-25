<?php

namespace heinthanth\bare\Http;

use Monolog\Logger;
use Psr\Http\Message\{ServerRequestInterface, ResponseInterface};
use Psr\Http\Server\{MiddlewareInterface, RequestHandlerInterface};
use Throwable;

class ExceptionHandler implements MiddlewareInterface
{
    /**
     * Logger instance
     * @var \Monolog\Logger
     */
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (Throwable $e) {
            return (new HttpExceptionHandler($e, $this->logger))->handle();
        }
    }
}
