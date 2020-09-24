<?php

namespace heinthanth\bare\Support;

use League\Plates\Engine;

class View
{
    private static function getEngine()
    {
        $engine = new Engine(BARE_PROJECT_ROOT . "/frontend/views");
        $engine->addFolder('__builtin', __DIR__ . "/../Builtins/views");
        $engine->addFolder('__builtin_stub', __DIR__ . "/../Builtins/templates");
        return $engine;
    }

    public static function render(string $path, array $data = [])
    {
        return self::getEngine()->render($path, $data);
    }
}
