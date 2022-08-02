<?php

namespace Nazonhou\LaravelServiceCreator\Commands;

use Illuminate\Console\Command;
use Nazonhou\LaravelServiceCreator\Services\ServiceFile;

class CreateServiceContractFileCommand extends Command
{
    public $serviceFile;

    public function __construct(ServiceFile $serviceFile)
    {
        parent::__construct();

        $this->serviceFile = $serviceFile;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:contract
                            {name : The service name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service contract class';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $servicePathName = $this->serviceFile->getServiceContractName(
            $this->argument('name')
        );

        $namespace = $this->serviceFile->getNamespace(
            rootNamespace: 'App',
            servicePathName: $servicePathName
        );

        $replacements = [
            '{{ namespace }}' => $namespace,
            '{{ serviceName }}' => basename(path: $servicePathName),
        ];

        $stub = $this->getStub();

        $this->serviceFile->createFileFromStub(
            stub: $stub,
            replacements: $replacements,
            servicePathName: $servicePathName
        );

        $this->info('Contract Created Successfully');

        return self::SUCCESS;
    }

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__.'/../../stubs/ServiceContract.php.stub';
    }
}
