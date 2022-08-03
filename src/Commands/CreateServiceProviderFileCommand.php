<?php

namespace Nazonhou\LaravelServiceCreator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Nazonhou\LaravelServiceCreator\Services\ServiceFile;

class CreateServiceProviderFileCommand extends Command
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
    protected $signature = 'make:service-provider
                            {contract : The fqdn of the service interface}
                            {service : The fqdn of the service implementation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service provider class in order to bind the contract to his implementation';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $serviceContractNamespace = $this->argument('contract');
        $serviceImplementationNamespace = $this->argument('service');
        $serviceProviderName = basename(path: str_replace(search: '\\', replace: '/', subject: $serviceContractNamespace)).'Provider';

        $replacements = [
            '{{ serviceContractNamespace }}' => $serviceContractNamespace,
            '{{ serviceImplementationNamespace }}' => $serviceImplementationNamespace,
            '{{ serviceProviderName }}' => $serviceProviderName,
            '{{ serviceContractName }}' => basename(path: str_replace(search: '\\', replace: '/', subject: $serviceContractNamespace)),
            '{{ serviceImplementationName }}' => basename(path: str_replace(search: '\\', replace: '/', subject: $serviceImplementationNamespace)),
        ];

        $stub = $this->getStub();

        $this->createFileFromStub(
            stub: $stub,
            replacements: $replacements,
            serviceProviderName: $serviceProviderName
        );

        $this->info('Service Provider Created Successfully');

        return self::SUCCESS;
    }

    /**
     * @return string
     */
    public function getStub(): string
    {
        return __DIR__.'/../../stubs/ServiceProvider.php.stub';
    }

    public function createFileFromStub(string $stub, array $replacements, string $serviceProviderName): void
    {
        $disk = Storage::build([
            'driver' => 'local',
            'root' => app_path(),
        ]);

        $path = 'Providers'.'/'.$serviceProviderName.'.php';

        $contents = str_replace(
            search: array_keys($replacements),
            replace: array_values($replacements),
            subject: file_get_contents($stub)
        );

        $disk->put(path: $path, contents: $contents);
    }
}
