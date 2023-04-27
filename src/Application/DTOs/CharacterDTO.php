<?php

declare(strict_types=1);


namespace Clickcars\Application\DTOs;

interface CharacterDTO
{
    public static function fromFilter(array $filter): self;
    public function getFilter(): ?array;

}