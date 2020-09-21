<?php

namespace heinthanth\bare\Http\Exceptions;

use League\Route\Http\Exception as LeagueHttpException;
use Exception;

class ServerErrorException extends LeagueHttpException
{
    /**
     * Constructor
     *
     * @param string    $message
     * @param Exception $previous
     * @param int $code
     */
    public function __construct(string $message = 'Internal Server Error', ?Exception $previous = null, int $code = 0)
    {
        parent::__construct(500, $message, $previous, [], $code);
    }
}
