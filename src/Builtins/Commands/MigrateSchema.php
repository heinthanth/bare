<?php

namespace heinthanth\bare\Builtins\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Illuminate\Database\Capsule\Manager as Capsule;

class MigrateSchema extends Command
{
    protected static $defaultName = 'migrate';

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->addArgument('fresh', InputArgument::OPTIONAL, 'Refresh all tables')
            ->setHelp('it will drop all tables and recreate again');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getArgument('fresh') === 'fresh') Capsule::schema()->dropAllTables();
        
        foreach (glob(BARE_PROJECT_ROOT . "/database/migrations/create_*_table.php") as $filename) {

            $name = pathinfo($filename, PATHINFO_BASENAME);
            $name = basename($name, '.php');
            if (preg_match('/create_(.*)_table/', $name, $matched)) {
                if (!Capsule::schema()->hasTable($matched[1])) {
                    require_once $filename;
                }
            }
        }
    }
}
