<?php

declare(strict_types=1);


namespace Clickcars\Application\DTOs;

class Character implements CharacterDTO
{
    private ?array $filter;

    /**
     * @param array|null $filter
     */
    private function __construct(?array $filter)
    {
        $this->filter = $filter;
    }

    public static function fromFilter(array $filter): self
    {
        return new self($filter);
    }

    /**
     * @return array|null
     */
    public function getFilter(): ?array
    {
        return $this->filter;
    }

}