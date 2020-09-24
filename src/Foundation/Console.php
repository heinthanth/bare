<?php

declare(strict_types=1);

namespace heinthanth\bare\Foundation;

use heinthanth\bare\Builtins\Commands\CreateController;
use heinthanth\bare\Builtins\Commands\CreateMiddleware;
use heinthanth\bare\Builtins\Commands\CreateMigration;
use heinthanth\bare\Builtins\Commands\CreateModel;
use heinthanth\bare\Builtins\Commands\MigrateSchema;
use Symfony\Component\Console\Application;

class Console
{
    /**
     * symfony console instance
     */
    private Application $console;

    public function __construct()
    {
        $this->console = new Application();
    }

    public function bootstrap()
    {
        $this->console->addCommands([
            new CreateController,
            new CreateMiddleware,
            new CreateModel,
            new CreateMigration,
            new MigrateSchema
        ]);
    }

    public function run()
    {
        $this->console->run();
    }
}
