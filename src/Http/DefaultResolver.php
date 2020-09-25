<?php

namespace heinthanth\bare\Http;

use Laminas\Diactoros\ResponseFactory;
use League\Route\Http\Exception\{MethodNotAllowedException, NotFoundException};
use League\Route\{Route, ContainerAwareInterface, ContainerAwareTrait};
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Psr\Http\Server\{MiddlewareInterface};
use League\Route\Strategy\AbstractStrategy;
use Monolog\Logger;
use Throwable;

class DefaultResolver extends AbstractStrategy implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * Logger instance
     * @var \Monolog\Logger;
     */
    private Logger $logger;

    /**
     * Set logger from DI.
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function invokeRouteCallable(Route $route, ServerRequestInterface $request): ResponseInterface
    {
        try {
            $controller = $route->getCallable($this->getContainer());
        } catch (Throwable $exception) {
            return (new HttpExceptionHandler($exception, $this->logger))->handle();
        }

        $response = $controller($request, $route->getVars());

        if ($this->isResponsible($response)) {
            $response = $this->createResponse($response);
        } else {
            $response = $this->applyDefaultResponseHeaders($response);
        }
        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function getNotFoundDecorator(NotFoundException $exception): MiddlewareInterface
    {
        return $this->throwThrowableMiddleware($exception);
    }

    /**
     * {@inheritdoc}
     */
    public function getMethodNotAllowedDecorator(MethodNotAllowedException $exception): MiddlewareInterface
    {
        return $this->throwThrowableMiddleware($exception);
    }

    /**
     * Return a middleware that simply throws an error
     *
     * @param \Throwable $error
     *
     * @return \Psr\Http\Server\MiddlewareInterface
     */
    protected function throwThrowableMiddleware(Throwable $error): MiddlewareInterface
    {
        return new HttpExceptionHandler($error, $this->logger);
    }

    /**
     * {@inheritdoc}
     */
    public function getExceptionHandler(): MiddlewareInterface
    {
        return $this->getThrowableHandler();
    }

    /**
     * {@inheritdoc}
     */
    public function getThrowableHandler(): MiddlewareInterface
    {
        return new ExceptionHandler($this->logger);
    }

    /**
     * Check if the response can be converted to JSON
     *
     * Arrays can always be converted, objects can be converted if they're not a response already
     *
     * @param mixed $response
     *
     * @return bool
     */
    protected function isJsonEncodable($response): bool
    {
        if ($response instanceof ResponseInterface)  return false;
        return (is_array($response) || is_object($response));
    }

    /**
     * Check if response is string or json.
     * Response will automatically created based on return value
     * @param mixed $response
     *
     * @return bool
     */
    protected function isResponsible($response): bool
    {
        if ($response instanceof ResponseInterface) return false;
        return (is_array($response) || is_object($response) || is_string($response) || is_numeric($response));
    }

    /**
     * Create response
     * @param mixed $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function createResponse($response)
    {
        $factory = new ResponseFactory;
        $res = $factory->createResponse();

        if ($this->isJsonEncodable($response)) {
            $data = json_encode($response, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            $res->getBody()->write($data);
            $this->addDefaultResponseHeader('content-type', 'application/json');
        } else {
            $res->getBody()->write($response);
        }

        $response = $this->applyDefaultResponseHeaders($res);
        return $response;
    }
}
