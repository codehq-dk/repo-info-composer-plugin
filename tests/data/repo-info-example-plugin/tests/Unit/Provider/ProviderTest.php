<?php

namespace CodeHqDk\RepositoryInformation\Tests\Unit\Provider;

use CodeHqDk\RepositoryInformation\Provider\HelloWorldInformationFactoryProvider;
use CodeHqDk\RepositoryInformation\Tests\Mock\MockProvider;
use PHPUnit\Framework\TestCase;

class ProviderTest extends TestCase
{
    public function testAddFactory(): void
    {
        $provider = new MockProvider();

        $hello_world_provider = new HelloWorldInformationFactoryProvider();

        $this->assertFalse($provider->register_in_dependency_injection_container_called);
        $this->assertFalse($provider->add_informaction_factory_to_registry_called);

        $hello_world_provider->addFactory($provider);

        $this->assertTrue($provider->register_in_dependency_injection_container_called);
        $this->assertTrue($provider->add_informaction_factory_to_registry_called);
    }
}