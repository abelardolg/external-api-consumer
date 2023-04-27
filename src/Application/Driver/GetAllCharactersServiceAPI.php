<?php

declare(strict_types=1);


namespace Clickcars\Application\Driver;

use Clickcars\Application\DTOs\CharacterDTOAPI;

interface GetAllCharactersServiceAPI
{
    public function findAllCharacters(): array;
}