<?php

use heinthanth\bare\Http\Exceptions\ServerErrorException;
use League\Route\Http\Exception\ForbiddenException;
use League\Route\Router;

$router = new Router();

// no routes, will throw 404

return $router;
