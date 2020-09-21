<?php

namespace heinthanth\bare\Handler;

use Exception;
use Laminas\Diactoros\Response\HtmlResponse;
use League\Route\Http\Exception\ForbiddenException;
use League\Route\Http\Exception\MethodNotAllowedException;
use League\Route\Http\Exception\NotFoundException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HttpErrorResponseHandler implements MiddlewareInterface
{
    /**
     * Error object
     * @var \Exception
     */
    protected $exception;

    public function __construct(Exception $e)
    {
        $this->exception = $e;
    }

    protected function response_template(int $code): ResponseInterface
    {
        return new HtmlResponse(render_template('__builtin::errors/' . $code), $code);
    }

    protected function responseHttpError(): ResponseInterface
    {
        return new HtmlResponse('<h1>Something went wrong!</h1>');
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (
            $this->exception instanceof NotFoundException ||
            $this->exception instanceof MethodNotAllowedException ||
            $this->exception instanceof ForbiddenException
        ) {
            return $this->response_template($this->exception->getStatusCode());
        } else if ($this->exception instanceof \League\Route\Http\Exception) {
            return $this->responseHttpError();
        } else {
            if (env('APP_ENVIRONMENT') === 'production') {
                return $this->responseHttpError();
            } else {
                throw $this->exception;
            }
        }
    }
}
