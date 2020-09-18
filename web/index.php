<?php

declare(strict_types=1);

use heinthanth\bare\Core\Bare;
use Laminas\Diactoros\ServerRequestFactory;

require_once __DIR__ . "/../vendor/autoload.php";

$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = require_once __DIR__ . "/../routes/web.php";

$bare = new Bare();
$bare->handle($request, $router);
