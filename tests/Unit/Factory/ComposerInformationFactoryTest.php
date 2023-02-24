<?php

namespace CodeHqDk\RepositoryInformation\Tests\Unit\Factory;

use CodeHqDk\RepositoryInformation\Factory\ComposerInformationfactory;
use CodeHqDk\RepositoryInformation\InformationBlocks\DirectDependenciesBlock;
use CodeHqDk\RepositoryInformation\Model\RepositoryRequirements;
use Lcobucci\Clock\FrozenClock;
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
        $factory = new ComposerInformationFactory(FrozenClock::fromUTC());

        $expected_block = new DirectDependenciesBlock(
            'Direct dependencies',
            'Number of dierect dependencies that this repository have',
            1,
            time(),
            '<p>codehq-dk/repo-info-contracts v0.0.1-alpha Repository Information Contract. Depend on this module when creation new repository information factory plugins</p>',
            'This information was created by the Composer plugin'
        );

        $path_to_sample_repository = dirname(__FILE__, 3) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'repo-info-example-plugin';

        $this->assertEquals([$expected_block], $factory->createBlocks($path_to_sample_repository));
    }
}
