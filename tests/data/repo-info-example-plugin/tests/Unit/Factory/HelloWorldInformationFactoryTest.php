<?php

namespace CodeHqDk\RepositoryInformation\Tests\Unit\Factory;

use CodeHqDk\RepositoryInformation\Factory\HelloWorldInformationFactory;
use CodeHqDk\RepositoryInformation\InformationBlocks\HelloWorldInformationBlock;
use CodeHqDk\RepositoryInformation\Model\RepositoryRequirements;
use PHPUnit\Framework\TestCase;

class HelloWorldInformationFactoryTest extends TestCase
{
    public function testListAvaiable(): void
    {
        $factory = new HelloWorldInformationFactory();
        $expected = [HelloWorldInformationBlock::class];
        $this->assertEquals($expected, $factory->listAvailableInformationBlocks());
    }

    public function testGetRepositoryRequirements(): void
    {
        $factory = new HelloWorldInformationFactory();
        $this->assertInstanceOf(RepositoryRequirements::class, $factory->getRepositoryRequirements());
    }

    public function testCreateBlocks(): void
    {
        $factory = new HelloWorldInformationFactory();

        $expected_block = new HelloWorldInformationBlock(
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