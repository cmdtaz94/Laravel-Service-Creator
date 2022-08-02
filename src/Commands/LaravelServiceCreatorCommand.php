<?php

namespace Nazonhou\LaravelServiceCreator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Nazonhou\LaravelServiceCreator\Services\ServiceFile;

class LaravelServiceCreatorCommand extends Command
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
    protected $signature = 'make:service
                            {name : Create a new service class}
                            {--no-contract : If the service won\'t have a contract}';

    protected $description = 'Generate service file';

    public function handle(): int
    {
        $withoutContract = $this->option('no-contract');
        $originalServicePathName = $this->argument('name');

        $servicePathName = $this->getServicePathName(
            withoutContract: $withoutContract,
            servicePathName: $originalServicePathName
        );

        $namespace = $this->serviceFile->getNamespace(
            rootNamespace: 'App',
            servicePathName: $servicePathName
        );

        $replacements = $this->getReplacements(
            withoutContract: $withoutContract,
            namespace: $namespace,
            servicePathName: $servicePathName,
            originalServicePathName: $originalServicePathName
        );

        $stub = $this->getStub(withoutContract: $withoutContract);

        if (! $withoutContract) {
            Artisan::call(
                command: CreateServiceContractFileCommand::class,
                parameters: ['name' => $originalServicePathName]
            );
        }

        $this->serviceFile->createFileFromStub(
            stub: $stub,
            replacements: $replacements,
            servicePathName: $servicePathName
        );

        $this->info('Service Created Successfully');

        return self::SUCCESS;
    }

    /**
     * @return string
     */
    protected function getStub(bool $withoutContract): string
    {
        if ($withoutContract) {
            return __DIR__.'/../../stubs/ServiceImplementation.php.stub';
        }

        return __DIR__.'/../../stubs/ServiceImplementationWithContract.php.stub';
    }

    public function getServicePathName(bool $withoutContract, string $servicePathName): string
    {
        if ($withoutContract) {
            return $this->serviceFile->getServiceContractName($servicePathName);
        }

        return $this->serviceFile->getServiceName($servicePathName);
    }

    public function getReplacementsWithoutContract(
        string $namespace,
        string $servicePathName
    ): array {
        return  [
            '{{ namespace }}' => $namespace,
            '{{ serviceName }}' => basename(path: $servicePathName),
        ];
    }

    public function getReplacementsWithContract(
        string $namespace,
        string $servicePathName,
        string $originalServicePathName
    ): array {
        return [
            '{{ namespace }}' => $namespace,
            '{{ serviceName }}' => basename(path: $servicePathName),
            '{{ serviceContract }}' => basename(path: $this->serviceFile->getServiceContractName($originalServicePathName)),
        ];
    }

    public function getReplacements(
        bool $withoutContract,
        string $namespace,
        string $servicePathName,
        ?string $originalServicePathName
    ) {
        if ($withoutContract) {
            return $this->getReplacementsWithoutContract(
                namespace: $namespace,
                servicePathName: $servicePathName
            );
        }

        return $this->getReplacementsWithContract(
            namespace: $namespace,
            servicePathName: $servicePathName,
            originalServicePathName: $originalServicePathName
        );
    }
}
