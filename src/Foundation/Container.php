<?php

namespace heinthanth\bare\Foundation;

use Laminas\HttpHandlerRunner\Emitter\EmitterStack;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\HttpHandlerRunner\Emitter\SapiStreamEmitter;
use League\Route\Router;
use Pimple\Container as PimpleContainer;
use Dotenv\Dotenv;
use heinthanth\bare\Http\Emitter\ConditionalEmitter;
use heinthanth\bare\Strategies\Application;
use heinthanth\bare\Support\View;
use Whoops\Handler\PrettyPageHandler;

class Container
{
    /**
     * Pimple container instance.
     * @var \Pimple\Container
     */
    private PimpleContainer $container;

    /**
     * Initialize pimple container
     */
    public function __construct()
    {
        $this->container = new PimpleContainer();
    }

    /**
     * Define most services and variables
     */
    public function defineService()
    {
        $this->container['services'] = function ($c) {
            return (require_once BARE_PROJECT_ROOT . "/config/services.php");
        };
        $this->container['dotEnv'] = function ($c) {
            if (file_exists(BARE_PROJECT_ROOT . "/.env")) return Dotenv::createImmutable(BARE_PROJECT_ROOT);
            return Dotenv::createImmutable(BARE_PROJECT_ROOT, '.env.example');
        };
        $this->container['sapiStreamEmitter'] = function ($c) {
            return new SapiStreamEmitter();
        };
        $this->container['sapiEmitter'] = function ($c) {
            return new SapiEmitter();
        };
        $this->container['conditionalEmitter'] = function ($c) {
            return new ConditionalEmitter($c['sapiStreamEmitter']);
        };
        $this->container['emitterStack'] = function ($c) {
            $stack = new EmitterStack();
            $stack->push($c['sapiEmitter']);
            $stack->push($c['conditionalEmitter']);
            return $stack;
        };
        $this->container['whoops'] = function ($c) {
            return new \Whoops\Run();
        };
        $this->container['view'] = function ($c) {
            return new View();
        };
        $this->container->extend('whoops', function (\Whoops\RUn $e, $c) {
            $e->pushHandler(new PrettyPageHandler);
            return $e;
        });
        $this->container['router'] = function ($c) {
            $globalMiddlewares = $c['services']['middlewares'];
            $f = BARE_PROJECT_ROOT . "/routes/web.php";

            $strg = new Application;

            $r = new Router();
            $r->middlewares($globalMiddlewares);
            $r->setStrategy($strg);

            if (!file_exists($f)) return $r;

            $dunno = require_once $f;
            if ($dunno instanceof Router) {
                $dunno->middlewares($globalMiddlewares);
                $dunno->setStrategy($strg);
                return $dunno;
            } else {
                return $r;
            }
        };
        $this->container['bare'] = function ($c) {
            return new Bare($c);
        };
    }

    /**
     * Load some services.
     * @return \Pimple\Container
     */
    public function bootstrap(): PimpleContainer
    {
        $this->defineService();
        $this->container['dotEnv']->load();
        $this->container['whoops']->register();
        return $this->container;
    }
}
