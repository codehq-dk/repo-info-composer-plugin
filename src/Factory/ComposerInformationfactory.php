<?php

namespace CodeHqDk\RepositoryInformation\Factory;

use CodeHqDk\RepositoryInformation\InformationBlocks\DirectDependenciesBlock;
use CodeHqDk\RepositoryInformation\Model\InformationBlock;
use CodeHqDk\RepositoryInformation\Model\RepositoryRequirements;

class ComposerInformationfactory implements InformationFactory
{
    public function createBlocks(string $local_path_to_code): array
    {
       return [
           new DirectDependenciesBlock(
               'Direct dependencies',
               'Number of dierect dependencies that this repository have',
               8,
               time(),
               'The list of dependencies',
               'This information was created by the Composer plugin'
           )
       ];
    }

    public function getRepositoryRequirements(): RepositoryRequirements
    {
        return new RepositoryRequirements(true, true, false, false);
    }

    public function listAvailableInformationBlocks(): array
    {
        return [
            DirectDependenciesBlock::class
        ];
    }
}
