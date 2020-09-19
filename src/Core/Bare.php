<?php

namespace heinthanth\bare\Core;

use Jenssegers\Blade\Blade;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\HtmlResponse;
use League\Route\Http\Exception;
use League\Route\Router;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

use Laminas\HttpHandlerRunner\Emitter\EmitterStack;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\HttpHandlerRunner\Emitter\SapiStreamEmitter;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;

/**
 * Application class to handle request and emit response.
 */
class Bare
{
    /**
     * router instance
     */
    private Router $router;

    /**
     * Set private Router instance
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Call request handler and middlewares
     * 
     * @param RequestInterface $request Request to be handled.
     * 
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        try {
            return $this->router->dispatch($request);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Handle errors such as NotFound, MethodNotAllowed, or other stuffs.
     */
    private function handleException(Exception $e): ResponseInterface
    {
        $blade = new Blade(__DIR__ . "/../Builtins/views/ErrorPages", __DIR__ . "/../Builtins/views/cache");
        $html = $blade->render('template', [
            'code' => $e->getStatusCode()
        ]);
        return new HtmlResponse($html);
    }

    /**
     * Emit response to browser.
     * If response is greater than 8kB, use StreamEmitter
     * 
     * @return EmitterInterface Emitter Stack
     */
    public function emit(ResponseInterface $response)
    {
        $sapiStreamEmitter = new SapiStreamEmitter();
        $conditionalEmitter = new ConditionalEmitter($sapiStreamEmitter);

        $stack = new EmitterStack();
        $stack->push(new SapiEmitter());
        $stack->push($conditionalEmitter);

        $stack->emit($response);
    }
}
