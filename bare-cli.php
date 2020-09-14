<?php

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/app/config/bootstrap.php";

use heinthanth\bare\Foundation\BareCLI;
use heinthanth\bare\Foundation\Console;

$action = $argv[1] ?? "";

switch ($action):
    case "serve":
        $host = (getenv('SERVER_HOST') === false || getenv('SERVER_HOST') === '') ? '127.0.0.1' :  getenv('SERVER_HOST');
        $port = (getenv('SERVER_PORT') === false || getenv('SERVER_PORT') === '') ? '8000' : getenv('SERVER_PORT');
        Console::Execute("php -S $host:$port -t web");
        break;
    case "make:controller":
        $name = $argv[2];
        BareCLI::makeController($name);
        break;
    default:
        echo "\nUsage: php bare-cli.php command [argument]\n\n";
        echo "Commands: \n";
        echo "- serve \t\t\t: Launch PHP development server\n";
        echo "- make:controller [name] \t: Create Controller\n";
        echo "\n";
        break;
endswitch;
