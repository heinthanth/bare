<?php

namespace heinthanth\bare\Routing\Exception;

use Exception;

class InvalidCallbackException extends Exception
{
    public function __construct($message = 'Oops! Invalid Callback!')
    {
        parent::__construct($message);
    }

    public function __toString()
    {
        return $this->message;
    }
}
