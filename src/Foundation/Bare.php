<?php

namespace heinthanth\bare\Foundation;

use Laminas\HttpHandlerRunner\Emitter\EmitterStack;
use Laminas\HttpHandlerRunner\Exception\EmitterException;
use League\Route\Router;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Bare
{
    /**
     * Router instance
     * @var \League\Route\Router
     */
    private Router $router;

    /**
     * Emitter stack instance
     * @var \Laminas\HttpHandlerRunner\Emitter\EmitterStack
     */
    private EmitterStack $emitter;

    /**
     * Response instance to sent
     * @var \Psr\Http\Message\ResponseInterface
     */
    private ResponseInterface $response;

    /**
     * constrctor for DI
     * @param \League\Route\Router $router
     * @param \Laminas\HttpHandlerRunner\Emitter\EmitterStack $emitterStack
     */
    public function __construct(Router $router, EmitterStack $emitterStack)
    {
        $this->router = $router;
        $this->emitter = $emitterStack;
    }

    /**
     * Handle request
     * @param \Psr\Http\Message\RequestInterface $request
     * 
     * @return \heinthanth\bare\Foundation\Bare
     */
    public function handle(RequestInterface $request): Bare
    {
        $this->response = $this->router->dispatch($request);
        return $this;
    }

    /**
     * Emit response to Browser
     */
    public function send()
    {
        try {
            $this->emitter->emit($this->response);
        } catch (EmitterException $e) {
        }
    }
}
