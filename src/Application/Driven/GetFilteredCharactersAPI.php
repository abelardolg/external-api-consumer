<?php

declare(strict_types=1);

namespace Clickcars\Application\Driven;

use Clickcars\Infrastructure\Driver\Presentation\DTOs\GetFilteredCharactersRequestDTO;

interface GetFilteredCharactersAPI
{
    public function findFilteredCharacters(GetFilteredCharactersRequestDTO $dto): array;
}
