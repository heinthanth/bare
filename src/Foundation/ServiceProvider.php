<?php

namespace heinthanth\bare\Foundation;

use Dotenv\Dotenv;
use heinthanth\bare\Http\ConditionalEmitter;
use heinthanth\bare\Http\DefaultResolver;
use heinthanth\bare\Support\Services;
use Illuminate\Database\Capsule\Manager;
use Laminas\HttpHandlerRunner\Emitter\{EmitterStack, SapiEmitter, SapiStreamEmitter};
use League\Container\ServiceProvider\{AbstractServiceProvider, BootableServiceProviderInterface};
use League\Route\Router;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    /**
     * The provided array is a way to let the container
     * know that a service is provided by this service
     * provider. Every service that is registered via
     * this service provider must have an alias added
     * to this array or it will be ignored.
     *
     * @var array
     */
    protected $provides = [
        'Laminas\HttpHandlerRunner\Emitter\EmitterStack',
        'Dotenv\Dotenv',
        'Illuminate\Database\Capsule\Manager',
        'League\Route\Router',
        'heinthanth\bare\Foundation\Bare'
    ];

    /**
     * This is where the magic happens, within the method you can
     * access the container and register or retrieve anything
     * that you need to, but remember, every alias registered
     * within this method must be declared in the `$provides` array.
     */
    public function register()
    {
        # emitter stack
        $this->getLeagueContainer()->add(EmitterStack::class, function () {
            $stack = new EmitterStack;
            $stack->push(new SapiEmitter);
            $stack->push(new ConditionalEmitter(new SapiStreamEmitter()));
            return $stack;
        });
        # dotEnv parser
        $this->getLeagueContainer()->add(Dotenv::class, function () {
            $dotenv = Dotenv::createImmutable(BARE_PROJECT_ROOT);
            return $dotenv;
        });
        # illuminate database ORM
        $this->getLeagueContainer()->add(Manager::class, function () {
            $capsule = new Manager();
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
        $this->getLeagueContainer()->add(Router::class, function () {
            $router = (require_once BARE_PROJECT_ROOT . "/routes/web.php");
            $middlewares = Services::get('middlewares') ?? [];

            $logger = new Logger('exception');
            $logger->pushHandler(new StreamHandler(BARE_PROJECT_ROOT . "/storage/framework/log/app.log", Logger::ERROR));

            $strg = new DefaultResolver($logger);
            $strg->setContainer($this->getLeagueContainer());
            
            $router->setStrategy($strg);
            $router->middlewares($middlewares);
            return $router;
        });
        $this->getLeagueContainer()->add(Bare::class)->addArgument(Router::class)->addArgument(EmitterStack::class);
    }

    /**
     * In much the same way, this method has access to the container
     * itself and can interact with it however you wish, the difference
     * is that the boot method is invoked as soon as you register
     * the service provider with the container meaning that everything
     * in this method is eagerly loaded.
     *
     * If you wish to apply inflectors or register further service providers
     * from this one, it must be from a bootable service provider like
     * this one, otherwise they will be ignored.
     */
    public function boot()
    {
    }
}
