<?php

namespace Nazonhou\LaravelServiceCreator\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nazonhou\LaravelServiceCreator\LaravelServiceCreatorServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Nazonhou\\LaravelServiceCreator\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelServiceCreatorServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-service-creator_table.php.stub';
        $migration->up();
        */
    }
}
