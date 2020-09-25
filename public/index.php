<?php

use heinthanth\bare\Foundation\Bare;
use Laminas\Diactoros\ServerRequestFactory;

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request and send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__ . "/../config/bootstrap.php";

$request = ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);

# dispatch request into response and sent to browser
$app->get(Bare::class)->handle($request)->send();
