<?php

declare(strict_types=1);

require_once __DIR__ . "/../vendor/autoload.php";

use heinthanth\bare\Core\Bare;
use Laminas\Diactoros\ServerRequestFactory;

require_once __DIR__ . "/../bootstrap/bootstrap.php";

/**
 * Start of applications
 */
$bare = new Bare($router);

$request = ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
$response = $bare->handle($request);

$bare->emit($response);
