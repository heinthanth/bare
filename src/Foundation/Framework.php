<?php

namespace heinthanth\bare\Foundation;

use Dotenv\Dotenv;
use heinthanth\bare\Support\Services;
use League\Container\{Container, ReflectionContainer};
use Illuminate\Database\Capsule\Manager as Capsule;

class Framework
{
    /**
     * Container instance
     * @var \League\Container\Container
     */
    private Container $container;

    /**
     * Initilize container and enable auto-wiring.
     */
    public function __construct()
    {
        $this->container = new Container();
        $this->container->delegate(
            (new ReflectionContainer)->cacheResolutions()
        );
        $this->container->addServiceProvider(new ServiceProvider);
        $providers = Services::get('providers') ?? [];
        foreach ($providers as $provider) {
            $this->container->addServiceProvider($provider);
        }
    }

    /**
     * Register service provider and return container
     * @return \League\Container\Container
     */
    public function bootstrap(): Container
    {
        # loads .env
        $this->container->get(Dotenv::class)->load();
        # boot laravel ORM
        $capsule = $this->container->get(Capsule::class);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        return $this->container;
    }
}
