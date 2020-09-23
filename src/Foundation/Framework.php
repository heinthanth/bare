<?php

declare(strict_types=1);


namespace heinthanth\bare\Foundation;

use Dotenv\Dotenv;
use heinthanth\bare\Http\Emitter\ConditionalEmitter;
use heinthanth\bare\Support\Services;
use Laminas\HttpHandlerRunner\Emitter\{EmitterStack, SapiEmitter, SapiStreamEmitter};
use League\Container\{Container, ReflectionContainer};
use League\Route\Router;
use heinthanth\bare\Strategies\HtmlForm;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use Illuminate\Database\Capsule\Manager as Capsule;

class Framework
{
    /**
     * Container instance for DI
     * @var \League\Container\Container;
     */
    private Container $container;

    /**
     * Initilize DI container
     * @return void
     */
    public function __construct()
    {
        $this->container = new Container();
        $this->container->delegate(
            (new ReflectionContainer)->cacheResolutions()
        );
    }

    private function defineService()
    {
        # config parser
        $this->container->add(Services::class);
        # emitters
        $this->container->add(EmitterStack::class, function () {
            $stack = new EmitterStack();
            $stack->push(new SapiEmitter);
            $stack->push(new ConditionalEmitter(new SapiStreamEmitter()));
            return $stack;
        });
        # dotenv parser
        $this->container->add(Dotenv::class, function () {
            if (file_exists(BARE_PROJECT_ROOT . "/.env"))
                return Dotenv::createImmutable(BARE_PROJECT_ROOT);
            return Dotenv::createImmutable(BARE_PROJECT_ROOT, '.env.example');
        });
        # exception beautifier
        $this->container->add(Run::class, function () {
            $run = new Run();
            $run->pushHandler(new PrettyPageHandler);
            return $run;
        });
        # eloquent orm
        $this->container->add(Capsule::class, function () {
            $capsule = new Capsule();
            $capsule->addConnection([
                'driver' => env('DB_CONNECTION', 'mysql'),
                'host' => env('DB_HOST', '127.0.0.1'),
                'port' => env('DB_PORT', 3306),
                'database' => env('DB_DATABASE', 'bare'),
                'username' => env('DB_USERNAME', 'root'),
                'password' => env('DB_PASSWORD', ''),
                'charset'   => env('DB_CHARSET', 'utf8mb4'),
                'collation' => env('DB_COLLATION', 'utf8mb4_general_ci'),
                'prefix' => env('DATABASE_PREFIX', '')
            ]);
            return $capsule;
        });
        # router
        $this->container->add(Router::class, function () {
            $middlewares = Services::get('middlewares');
            if (!is_array($middlewares)) $middlewares = [];

            $routeFile = BARE_PROJECT_ROOT . "/routes/web.php";

            $strg = new HtmlForm;
            $strg->setContainer($this->container);

            $router = new Router();
            $router->middlewares($middlewares);
            $router->setStrategy($strg);

            if (!file_exists($routeFile)) return $router;
            $dunno = require_once $routeFile;

            if ($dunno instanceof Router) {
                $dunno->middlewares($middlewares);
                $dunno->setStrategy($strg);
                return $dunno;
            }

            return $router;
        });
        $this->container->add(Bare::class)->addArgument(Router::class)->addArgument(EmitterStack::class);
    }

    private function loadService()
    {
        $this->defineService();
        $this->container->get(Dotenv::class)->load();
        $capsule = $this->container->get(Capsule::class);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        $this->container->get(Run::class)->register();
    }

    public function bootstrap()
    {
        $this->loadService();
        return $this->container;
    }
}
