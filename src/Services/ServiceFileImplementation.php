<?php

namespace Nazonhou\LaravelServiceCreator\Services;

use Illuminate\Support\Facades\Storage;

class ServiceFileImplementation implements ServiceFile
{
    public $disk;

    public $separator = '/';

    public function __construct()
    {
        $this->disk = Storage::build([
            'driver' => 'local',
            'root' => app_path(),
        ]);
    }

    /**
     * @param  string  $rootNamespace
     * @return string
     */
    public function getNamespace(string $rootNamespace, string $servicePathName): string
    {
        $paths = explode(separator: $this->separator, string: $servicePathName);

        $namespace = $rootNamespace.'\\Services';

        for ($index = 0; $index < count($paths) - 1; $index++) {
            $namespace .= '\\'.ucfirst($paths[$index]);
        }

        return $namespace;
    }

    /**
     * @param  string  $serviceName
     * @return string
     */
    public function getServiceName(string $serviceName): string
    {
        if (! str_ends_with(haystack: $serviceName, needle: 'Service')) {
            return $serviceName.'ServiceImplementation';
        }

        return $serviceName.'Implementation';
    }

    /**
     * @param  string  $serviceName
     * @return string
     */
    public function getServiceContractName(string $serviceName): string
    {
        if (! str_ends_with(haystack: $serviceName, needle: 'Service')) {
            return $serviceName.'Service';
        }

        return $serviceName;
    }

    /**
     * @param  string  $servicePathName
     * @return string
     */
    public function makeDirectory(string $servicePathName): string
    {
        $path = 'Services'.'/'.$servicePathName;

        $directory = dirname($path);

        if (! $this->disk->exists($directory)) {
            $this->disk->makeDirectory(path: $directory);
        }

        return $path;
    }

    /**
     * @param  string  $stub
     * @param  array  $replacements
     * @param  string  $servicePathName
     * @return void
     */
    public function createFileFromStub(
        string $stub,
        array $replacements,
        string $servicePathName
    ): void {
        $defaultContents = file_get_contents($stub);

        $customContents = str_replace(
            search: array_keys($replacements),
            replace: array_values($replacements),
            subject: $defaultContents
        );

        $path = $this->makeDirectory(servicePathName: $servicePathName);

        $this->disk->put(path: $path.'.php', contents: $customContents);
    }
}
