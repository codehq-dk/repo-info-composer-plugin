<?php

namespace CodeHqDk\RepositoryInformation\ComposerPlugin\Tests\Unit\Factory;

use CodeHqDk\RepositoryInformation\ComposerPlugin\Factory\ComposerInformationfactory;
use CodeHqDk\RepositoryInformation\ComposerPlugin\InformationBlocks\DirectDependenciesBlock;
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

        $expected_github_test_string = '<p>codehq-dk/repo-info-contracts v0.0.1-alpha Repository Information Contrac';
        $path_to_sample_repository = dirname(__FILE__, 3) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'repo-info-example-plugin';
        $actual_blocks = $factory->createBlocks($path_to_sample_repository, ComposerInformationfactory::DEFAULT_ENABLED_BLOCKS, false);
        /**
         * @var DirectDependenciesBlock $actual_block
         */
        $actual_block = array_pop($actual_blocks);

        $this->assertEquals($expected_block->getHeadline(), $actual_block->getHeadline());
        $this->assertEquals($expected_block->getLabel(), $actual_block->getLabel());
        $this->assertEquals($expected_block->getValue(), $actual_block->getValue());
        $this->assertEquals($expected_block->getModifiedTimestamp(), $actual_block->getModifiedTimestamp());
        $this->assertStringContainsString($expected_github_test_string, $actual_block->getDetails());
        $this->assertEquals($expected_block->getInformationOrigin(), $actual_block->getInformationOrigin());
    }
}
