<?php

declare(strict_types=1);


namespace Clickcars\Application\Driven;

use Clickcars\Domain\Exceptions\NoDataFoundException;

interface GetAllCharactersAPI
{
    /**
     * @throws NoDataFoundException
     */
    public function findAllCharacters(): array;
}