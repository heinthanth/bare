<?php

namespace heinthanth\bare\Routing\Exception;

use Exception;

class CallbackNotExistsException extends Exception
{
    public function __construct($message = 'Oops! Invalid Callback: method not exists!')
    {
        parent::__construct($message);
    }

    public function __toString()
    {
        return $this->message;
    }
}
