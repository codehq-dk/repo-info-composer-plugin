<?php

namespace CodeHqDk\RepositoryInformation\Model;

use CodeHqDk\RepositoryInformation\InformationBlocks\RepositoryNameInformationBlock;
use CodeHqDk\RepositoryInformation\InformationBlocks\RepositoryTypeInformationBlock;
use Exception;

interface Repository
{
    /**
     * @throws Exception An exception is thrown if download fails
     */
    public function downloadCodeToLocalPath(string $local_path): void;

    public function createRepositoryTypeInformationBlock(): RepositoryTypeInformationBlock;

    public function createRepositoryNameInformationBlock(): RepositoryNameInformationBlock;

    public function getId(): string;

    public function getRepositoryCharacteristics(): RepositoryCharacteristics;

    public function toArray(): array;

    public static function fromArray(array $array): self;
}
