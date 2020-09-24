<?php

declare(strict_types=1);

namespace heinthanth\bare\Foundation;

use heinthanth\bare\Builtins\Commands\CreateController;
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
        $this->console->add(new CreateController);
    }

    public function run()
    {
        $this->console->run();
    }
}
