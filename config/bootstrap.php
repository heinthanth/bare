<?php

use heinthanth\bare\Foundation\Framework;

define('BARE_PROJECT_ROOT',  $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__));

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
| Bootstrap application
| ----------------------------------------
| Glue all dependencies and Get application for handle request
|
*/

$app = (new Framework)->bootstrap();

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
