<?php

namespace CodeHqDk\RepositoryInformation\Provider;

use CodeHqDk\RepositoryInformation\Factory\HelloWorldInformationFactory;
use CodeHqDk\RepositoryInformation\Factory\InformationFactoryProvider;
use CodeHqDk\RepositoryInformation\Service\ProviderDependencyService;

class HelloWorldInformationFactoryProvider implements InformationFactoryProvider
{
    public function addFactory(ProviderDependencyService $provider_dependency_service): void
    {
        $provider_dependency_service->registerClassInDependencyContainer(HelloWorldInformationFactory::class);
        $provider_dependency_service->addInformactionFactoryToRegistry(new HelloWorldInformationFactory());
    }
}