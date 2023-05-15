<?php

namespace CodeHqDk\RepositoryInformation\ComposerPlugin\Provider;

use CodeHqDk\RepositoryInformation\ComposerPlugin\Factory\ComposerInformationfactory;
use CodeHqDk\RepositoryInformation\Factory\InformationFactoryProvider;
use CodeHqDk\RepositoryInformation\Service\ProviderDependencyService;

class ComposerInformationFactoryProvider implements InformationFactoryProvider
{
    public function addFactory(ProviderDependencyService $provider_dependency_service): void
    {
        $provider_dependency_service->registerClassInDependencyContainer(ComposerInformationFactory::class);
        $provider_dependency_service->addInformactionFactoryToRegistry(new ComposerInformationFactory());
    }
}
