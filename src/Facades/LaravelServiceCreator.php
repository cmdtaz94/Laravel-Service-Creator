<?php

namespace Nazonhou\LaravelServiceCreator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Nazonhou\LaravelServiceCreator\LaravelServiceCreator
 */
class LaravelServiceCreator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Nazonhou\LaravelServiceCreator\LaravelServiceCreator::class;
    }
}
