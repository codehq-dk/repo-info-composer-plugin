<?php

namespace CodeHqDk\RepositoryInformation\Model;

interface InformationBlock
{
    /**
     * Fully qualified class name
     */
    public const INFO_TYPE_ID = self::class;

    /**
     * Should return fully qualified class name
     */
    public function getInfoTypeId(): string;

    public function getHeadline(): string;

    /**
     * When was this information block modified
     */
    public function getModifiedTimestamp(): int;

    public function getValue(): string;

    public function getLabel(): string;

    /**
     * Optional field, can also contain html
     */
    public function getDetails(): ?string;

    /**
     * Optinal field - put e.g. The factory that made the info / copyright info etc. here
     */
    public function getInformationOrigin(): ?string;

    public static function fromArray(array $array): self;

    public function toArray(): array;
}