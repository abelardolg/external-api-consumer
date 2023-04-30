<?php

declare(strict_types=1);

namespace Clickcars\Domain\Driven;

use Clickcars\Domain\Exceptions\NoDataFoundException;

interface CharactersProvider
{
    /**
     * @throws NoDataFoundException
     */
    public function findAllCharacters(): array;

    public function findByFilter(array $filter): array;
}
