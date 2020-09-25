<?php

namespace heinthanth\bare\Http;

use Laminas\HttpHandlerRunner\Emitter\{EmitterInterface, SapiStreamEmitter};
use Psr\Http\Message\ResponseInterface;

class ConditionalEmitter implements EmitterInterface
{
    /**
     * stream emitter instace
     */
    private SapiStreamEmitter $emitter;

    public function __construct(SapiStreamEmitter $emitter)
    {
        $this->emitter = $emitter;
    }

    /**
     * use just emitter if no 'Content-Disposition' & 'Content-Range' headers.
     *
     * @param ResponseInterface $response
     *
     * @return bool
     */
    public function emit(ResponseInterface $response): bool
    {
        if (!$response->hasHeader('Content-Disposition') && !$response->hasHeader('Content-Range')) {
            return false;
        }
        return $this->emitter->emit($response);
    }
}
