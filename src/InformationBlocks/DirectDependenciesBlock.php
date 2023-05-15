<?php

namespace CodeHqDk\RepositoryInformation\ComposerPlugin\InformationBlocks;

use CodeHqDk\RepositoryInformation\Model\BaseInformationBlock;

/**
 * Use this class to get information about how many and which direct dependencies your code repository have
 */
class DirectDependenciesBlock extends BaseInformationBlock
{
    public static function fromArray(array $array): self {
        return new self(
            $array['headline'],
            $array['label'],
            $array['value'],
            $array['modified_timestamp'],
            $array['details'],
            $array['information_origin'],
        );
    }
}
