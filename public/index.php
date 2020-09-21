<?php

use Laminas\Diactoros\ServerRequestFactory;

define('BARE_START_TIME', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require_once __DIR__ . "/../vendor/autoload.php";


/*
| ----------------------------------------
| Run applications
| ----------------------------------------
| handle ServerRequest into Response. and
| Send response to browser using EmitterStack.
|
*/

$app = require_once __DIR__ . "/../config/bootstrap.php";

$request = ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);

$response = $app->handle($request);

$app->send($response);
