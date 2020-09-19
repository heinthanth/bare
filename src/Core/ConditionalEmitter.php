<?php

namespace heinthanth\bare\Core;

use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Psr\Http\Message\ResponseInterface;

class ConditionalEmitter implements EmitterInterface
{
    private $emitter;

    public function __construct(EmitterInterface $emitter)
    {
        $this->emitter = $emitter;
    }

    /**
     * If response size is greater than 8kB, use stream emitter.
     * @return bool
     */
    public function emit(ResponseInterface $response): bool
    {
        if (
            !$response->hasHeader('Content-Disposition')
            && !$response->hasHeader('Content-Range')
        ) {
            return false;
        }
        return $this->emitter->emit($response);
    }
};
