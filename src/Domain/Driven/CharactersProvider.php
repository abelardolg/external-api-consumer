<?php

declare(strict_types=1);


namespace Clickcars\Domain\Driven;

interface CharactersProvider
{
    public function getCharacters(array $filter): array;
}