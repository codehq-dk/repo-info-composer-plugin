<?php

namespace CodeHqDk\RepositoryInformation\Factory;

use CodeHqDk\RepositoryInformation\InformationBlocks\HelloWorldInformationBlock;
use CodeHqDk\RepositoryInformation\Model\RepositoryRequirements;

class HelloWorldInformationFactory implements InformationFactory
{
    public function createBlocks(string $local_path_to_code): array
    {
        return [
            new HelloWorldInformationBlock(
                'Information plugin exmaple',
                'Hello World',
                'This is the famous Hello World',
                time(),
                'Details from hello world...',
                'This is information from the Hello World Information Factory',
            )
        ];
    }

    public function getRepositoryRequirements(): RepositoryRequirements
    {
        return new RepositoryRequirements(false, false, false, false);
    }

    public function listAvailableInformationBlocks(): array
    {
        return [
            HelloWorldInformationBlock::class
        ];
    }
}