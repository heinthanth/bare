<?php

use heinthanth\bare\Foundation\Container;

define('BARE_PROJECT_ROOT', dirname(__DIR__));

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Bare application instance
| which serves as the "glue" for all the components, and is
| the IoC container for the system binding all of the various parts.
|
*/

$container = new Container();
$app = $container->bootstrap();

return $app['bare'];
