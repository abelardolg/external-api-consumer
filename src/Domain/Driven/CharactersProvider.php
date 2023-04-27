<?php

declare(strict_types=1);


namespace Clickcars\Domain\Driven;

interface CharactersProvider
{
    public function findAllCharacters(): array;
    public function findByFilter(array $filter): array;
}