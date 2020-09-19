<?php

use Dotenv\Dotenv;
use League\Route\Router;

$dotenv = (file_exists(__DIR__ . '/../.env')) ? Dotenv::createImmutable(__DIR__ . '/../') : Dotenv::createImmutable(__DIR__ . '/../', '.env.example');
$dotenv->load();

define('PROJECT_ROOT', __DIR__ . "/..");

$dunno = require_once __DIR__ . "/../routes/web.php";
$router = new Router();

if ($dunno instanceof Router) :
    $router = $dunno;
endif;
