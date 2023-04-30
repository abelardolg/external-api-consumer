<?php

declare(strict_types=1);

namespace Clickcars\Application\Driver;

interface GetFilteredCharactersServiceAPI
{
    public function findFilteredCharacters(array $filter): array;
}
