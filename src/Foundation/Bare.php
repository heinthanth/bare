<?php

namespace heinthanth\bare\Foundation;

use Laminas\HttpHandlerRunner\Emitter\EmitterStack;
use League\Route\Router;
use Psr\Http\Message\{RequestInterface, ResponseInterface};

class Bare
{
    /**
     * Router instance
     * @var \League\Route\Router
     */
    private Router $router;

    /**
     * Emitter Stack instance
     * @var \Laminas\HttpHandlerRunner\Emitter\EmitterStack
     */
    private EmitterStack $emitterStack;

    /**
     * Get router instance.
     */
    public function __construct(Router $router, EmitterStack $emitterStack)
    {
        $this->router = $router;
        $this->emitterStack = $emitterStack;
    }

    /**
     * dispatch Http Request into Response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        return $this->router->dispatch($request);
    }

    public function send(ResponseInterface $response)
    {
        $this->emitterStack->emit($response);
    }
}
