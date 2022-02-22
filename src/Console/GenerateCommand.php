<?php

declare(strict_types=1);

namespace LaravelDoctrine\Migrations\Console;

use LaravelDoctrine\Migrations\Configuration\DependencyFactoryProvider;

class GenerateCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'doctrine:migrations:generate
    {--connection= : The entity manager connection to generate the migration for.}
    {--create= : The table to be created.}
    {--table= : The table to migrate.}';

    /**
     * @var string
     */
    protected $description = 'Generate a blank migration class.';

    /**
     * Execute the console command.
     *
     * @param DependencyFactoryProvider $provider
     * @return int
     * @throws \Exception
     */
    public function handle(DependencyFactoryProvider $provider): int
    {
        $dependencyFactory = $provider->getForConnection($this->option('connection'));

        $command = new \Doctrine\Migrations\Tools\Console\Command\GenerateCommand($dependencyFactory);

        return $command->run($this->getDoctrineInput(), $this->output->getOutput());
    }
}
