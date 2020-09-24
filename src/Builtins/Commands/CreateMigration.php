<?php

namespace heinthanth\bare\Builtins\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateMigration extends Command
{
    protected static $defaultName = 'make:migration';

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->addArgument('table', InputArgument::REQUIRED, 'table name for migration')
            ->setHelp('table name to create Schema');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = $input->getArgument('table');
        $this->createFile($table, $output);
    }

    private function createFile(string $table, OutputInterface $output)
    {
        $formatter = $this->getHelper('formatter');
        $dir = BARE_PROJECT_ROOT . "/database/migrations";

        $file = $dir . "/create_" . $table . "_table.php";
        if (!file_exists($dir)) mkdir($dir, 755, true);

        if (file_exists($file)) {
            $errorMessages = ['', 'Migration ' . $file . ' exists!', ''];
            $formattedBlock = $formatter->formatBlock($errorMessages, 'error');
            $output->writeln("\n" . $formattedBlock);
            return Command::FAILURE;
        }

        $strings = render_template('__builtin_stub::Migration', [
            'table' => $table,
        ]);

        $file = fopen($file, 'w');
        $success = fwrite($file, $strings);

        if (!$success) return Command::FAILURE;

        return Command::SUCCESS;
    }
}
