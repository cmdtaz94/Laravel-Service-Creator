<?php

namespace Nazonhou\LaravelServiceCreator;

use Nazonhou\LaravelServiceCreator\Commands\CreateServiceContractFileCommand;
use Nazonhou\LaravelServiceCreator\Commands\LaravelServiceCreatorCommand;
use Nazonhou\LaravelServiceCreator\Services\ServiceFile;
use Nazonhou\LaravelServiceCreator\Services\ServiceFileImplementation;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelServiceCreatorServiceProvider extends PackageServiceProvider
{
    public array $bindings = [
        ServiceFile::class => ServiceFileImplementation::class,
    ];

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-service-creator')
            ->hasConfigFile('service-creator')
            ->hasViews()
            ->hasMigration('create_laravel-service-creator_table')
            ->hasCommand(LaravelServiceCreatorCommand::class)
            ->hasCommand(CreateServiceContractFileCommand::class);
    }
}
