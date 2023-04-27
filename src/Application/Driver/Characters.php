<?php

declare(strict_types=1);


namespace Clickcars\Application\Driver;

use Clickcars\Application\DTOs\CharacterDTO;

interface Characters
{
    public function getCharacters(CharacterDTO $characterDTO): array;
}