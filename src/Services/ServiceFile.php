<?php

namespace Nazonhou\LaravelServiceCreator\Services;

interface ServiceFile
{
    public function getNamespace(string $rootNamespace, string $servicePathName): string;

    public function getServiceName(string $serviceName): string;

    public function getServiceContractName(string $serviceName): string;

    public function makeDirectory(string $servicePathName): string;

    public function createFileFromStub(
        string $stub,
        array $replacements,
        string $servicePathName
    ): void;
}
