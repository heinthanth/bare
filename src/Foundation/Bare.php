<?php

namespace heinthanth\bare\Foundation;

use Pimple\Container as PimpleContainer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Bare
{
    /**
     * Pimple container instance
     * @var \Pimple\Container
     */
    private PimpleContainer $container;

    /**
     * Get pimple container instance
     * @param \Pimple\Container $container
     */
    public function __construct(PimpleContainer $container)
    {
        $this->container = $container;
    }

    public function handle(ServerRequestInterface $request)
    {
        try {
            return $this->container['router']->dispatch($request);
        } catch (\League\Route\Http\Exception $e) {
        }
    }

    public function send(ResponseInterface $response)
    {
        $this->container['emitterStack']->emit($response);
    }
}
