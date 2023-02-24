<?php

namespace CodeHqDk\RepositoryInformation\Model;

class RepositoryRequirements
{
    protected const CONTAINS_PHP = 0;
    protected const COMPOSER_PACKAGE = 1;
    protected const CODECEPTION_USED = 2;
    protected const CONTAINS_JAVASCRIPT = 3;

    protected array $list;

    public function __construct(bool $contains_php, bool $composer_package, bool $codeception_used, bool $contains_javascript)
    {
        $this->list[self::CONTAINS_PHP] = $contains_php;
        $this->list[self::COMPOSER_PACKAGE] = $composer_package;
        $this->list[self::CODECEPTION_USED] = $codeception_used;
        $this->list[self::CONTAINS_JAVASCRIPT] = $contains_javascript;
    }

    public function list(): array
    {
        return $this->list;
    }
}
