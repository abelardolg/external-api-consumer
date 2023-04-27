<?php

declare(strict_types=1);


namespace Clickcars\Application\Driven;

interface GetAllCharactersAPI
{
    public function findAllCharacters(): array;
}