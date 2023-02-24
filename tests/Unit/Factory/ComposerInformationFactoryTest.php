<?php

namespace CodeHqDk\RepositoryInformation\Tests\Unit\Factory;

use CodeHqDk\RepositoryInformation\Factory\ComposerInformationfactory;
use CodeHqDk\RepositoryInformation\InformationBlocks\DirectDependenciesBlock;
use CodeHqDk\RepositoryInformation\Model\RepositoryRequirements;
use PHPUnit\Framework\TestCase;

class ComposerInformationFactoryTest extends TestCase
{
    public function testListAvaiable(): void
    {
        $factory = new ComposerInformationFactory();
        $expected = [DirectDependenciesBlock::class];
        $this->assertEquals($expected, $factory->listAvailableInformationBlocks());
    }

    public function testGetRepositoryRequirements(): void
    {
        $factory = new ComposerInformationFactory();
        $this->assertInstanceOf(RepositoryRequirements::class, $factory->getRepositoryRequirements());
    }

    public function testCreateBlocks(): void
    {
        $factory = new ComposerInformationFactory();

        $expected_block = new DirectDependenciesBlock(
            'Information plugin exmaple',
            'Hello World',
            'This is the famous Hello World',
            time(),
            'Details from hello world...',
            'This is information from the Hello World Information Factory',
        );

        $this->assertEquals([$expected_block], $factory->createBlocks(''));
    }
}
