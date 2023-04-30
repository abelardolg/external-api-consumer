<?php

declare(strict_types=1);

namespace Clickcars\Application\Driver;

use Clickcars\Domain\Exceptions\NoDataFoundException;

interface GetAllCharactersServiceAPI
{
    /**
     * @throws NoDataFoundException
     */
    public function findAllCharacters(): array;
}
