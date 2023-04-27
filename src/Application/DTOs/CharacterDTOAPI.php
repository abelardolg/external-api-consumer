<?php

declare(strict_types=1);


namespace Clickcars\Application\DTOs;

interface CharacterDTOAPI
{
    public static function fromFilter(array $filter): self;
    public function getFilter(): ?array;

}