<?php

namespace CodeHqDk\RepositoryInformation\Factory;

use CodeHqDk\RepositoryInformation\Service\ProviderDependencyService;

interface InformationFactoryProvider
{
    public function addFactory(ProviderDependencyService $provider_dependency_service): void;
}