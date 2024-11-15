<?php

namespace App\Commands;

use Symfony\Component\Process\Process;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DbMigrateCommand extends Command
{
    /** @var string Command name */
    protected static $defaultName = 'db:migrate';

    /**
     * Sets descriptions, options or arguments.
     * 
     * ```php
     * $ php aeros db:migrate
     * ```
     * @link https://symfony.com/doc/current/components/console.html
     * @return void
     */
    protected function configure()
    {
        // This text will be displayed when: `$ php db:migrate --help`
        $this->setDescription('Aeros REPL - "db:migrate" command.')
            ->setHelp('Commands help...');

        $this->addOption('environment', null, InputOption::VALUE_OPTIONAL, 'Option "environment", if provided, it determines the environment');
        $this->addOption('withSeeds', null, InputOption::VALUE_NONE, 'Option "withSeeds", if provided, all seeders will be called');
        $this->addOption('seed', null, InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Option "seed", if given, only these will be called');
    }

    /**
     * Sets the input and gets the out of current command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Confirm if App/Database/migrations dir exists
        if (! is_dir($migrationDir = app()->basedir . '/Database/migrations')) {
            mkdir($migrationDir);
        }

        // Confirm if App/Database/seeds dir exists
        if (! is_dir($seedDir = app()->basedir . '/Database/seeds')) {
            mkdir($seedDir);
        }

        $phinx = app()->basedir . '/../vendor/bin/phinx';

        // Migrate
        $output->write('==> Migrating all... ');

        $opts = [
            $phinx, 
            'migrate'
        ];

        // Set the environment if any
        if ($environment = $input->getOption('environment')) {
            $opts[] = '--environment=' . $environment;
        }

        $migrate = new Process($opts);

        $migrate->mustRun();
        $output->writeln('<fg=green;options=bold>Ok.</>');

        // Run all seeders
        if ($input->getOption('withSeeds')) {
            $output->write('==> Seeding database... ');

            $seeding = new Process([
                $phinx, 
                'seed:run'
            ]);

            $seeding->mustRun();
            $output->writeln('<fg=green;options=bold>Ok.</>');
        }

        // Specific seeders
        if ($seeds = $input->getOption('seed')) {
            foreach ($seeds as $seed) {
                $output->writeln(sprintf("Option 'seed': %s", $seed));
            }
        }

        return Command::SUCCESS;
    }
}
