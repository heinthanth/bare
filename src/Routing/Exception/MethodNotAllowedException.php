<?php

namespace heinthanth\bare\Routing\Exception;

use Exception;

class MethodNotAllowedException extends Exception
{
    public function __construct($message = 'Oops! Method not allowed!')
    {
        parent::__construct($message);
    }

    public function __toString()
    {
        return $this->message;
    }
}
