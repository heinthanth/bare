<?php

namespace heinthanth\bare\Routing\Exception;

use Exception;

class RouteNotFoundException extends Exception
{
    public function __construct($message = 'Oops! Route not found!')
    {
        parent::__construct($message);
    }

    public function __toString()
    {
        return $this->message;
    }
}
