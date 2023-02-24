<?php

namespace CodeHqDk\RepositoryInformation\Model;

/**
 * Use this class as a starting point, often you probably do not need to add or adjust much except adding the fromArray method
 */
abstract class BaseInformationBlock implements InformationBlock
{
    public function __construct(
        private readonly string $headline,
        private readonly string $label,
        private readonly string $value,
        private readonly int $modified_timestamp,
        private readonly ?string $details = null,
        private readonly ?string $information_origin = null,
    ) {
    }

    /**
     * You can easily implement this method in your plugin like shown below
     *
    * public static function fromArray(array $array): self {
    *   return new self(
    *       $array['headline'],
    *       $array['label'],
    *       $array['value'],
    *       $array['modified_timestamp'],
    *       $array['details'],
    *       $array['information_origin'],
    *   );
    *}
     */
    abstract public static function fromArray(array $array): self;

    public function getHeadline(): string
    {
        return $this->headline;
    }

    public function getInformationOrigin(): ?string
    {
        return $this->information_origin;
    }

    public function getModifiedTimestamp(): int
    {
        return $this->modified_timestamp;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getInfoTypeId(): string
    {
        return static::class;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function toArray(): array
    {
        return
            [
                'info_type' => static::class,
                'headline' => $this->headline,
                'information_origin' => $this->information_origin,
                'modified_timestamp' => $this->modified_timestamp,
                'label' => $this->label,
                'value' => $this->value,
                'details' => $this->details
            ];
    }
}