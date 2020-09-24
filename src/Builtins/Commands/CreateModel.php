<?php

declare(strict_types=1);

namespace heinthanth\bare\Builtins\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateModel extends Command
{
    protected static $defaultName = 'make:model';

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Creates a new Model')
            ->setHelp('Create model into App\\Model namespace');

        $this->addArgument('name', InputArgument::REQUIRED, 'model name');
        $this->addArgument('namespace', InputArgument::OPTIONAL, 'namespace for model. Foo will resolve to App\\Models\\Foo', '');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $model = $input->getArgument('name');
        $inputNamespace = rtrim($input->getArgument('namespace'), '\\');

        if ($inputNamespace === '') {
            $namespace = 'App\Http\Models\\';
        } else {
            $namespace = 'App\Http\\Models\\' . $inputNamespace . '\\';
        }

        $pattern = '/^App\\\\Http\\\\Models\\\\(([A-Za-z_][A-Za-z0-9_]*\\\\)*)$/';
        if (preg_match($pattern, $namespace, $matched)) {
            $dir = $matched[1];
            $np = 'App\\Models\\' . $dir;
            $outdir = 'app\\Models\\' . $dir;
            $this->createFile($model, $np, $outdir, $output);
        } else {
            $output->writeln("Invalid namespace");
            return Command::FAILURE;
        }
    }

    private function createFile(string $class, string $namespace, string $outdir, OutputInterface $output)
    {
        $formatter = $this->getHelper('formatter');

        $dir = str_replace('\\', '/', $outdir);
        $file = $dir . $class . '.php';
        if (!file_exists($dir)) mkdir($dir, 755, true);

        if (file_exists($file)) {
            $errorMessages = ['', 'Model ' . $file . ' exists!', ''];
            $formattedBlock = $formatter->formatBlock($errorMessages, 'error');
            $output->writeln("\n" . $formattedBlock);
            return Command::FAILURE;
        }

        $strings = render_template('__builtin_stub::Model', [
            'model' => $class,
            'namespace' => rtrim($namespace, '\\')
        ]);

        $file = fopen($file, 'w');
        $success = fwrite($file, $strings);

        if (!$success) return Command::FAILURE;

        return Command::SUCCESS;
    }
}