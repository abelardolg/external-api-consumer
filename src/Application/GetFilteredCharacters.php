<?php

declare(strict_types=1);


namespace Clickcars\Application;

use Clickcars\Application\Driven\GetFilteredCharactersAPI;
use Clickcars\Application\Driver\GetFilteredCharactersServiceAPI;
use Clickcars\Domain\Exceptions\InvalidArgumentException;
use Clickcars\Infrastructure\Driver\Presentation\DTOs\GetFilteredCharactersRequestDTO;

class GetFilteredCharacters implements GetFilteredCharactersAPI
{

    public function __construct(private readonly GetFilteredCharactersServiceAPI $service) {}

    /**
     * @param GetFilteredCharactersRequestDTO $dto an object which contains useful information
     * @return array a Character collection
     */
    public function findFilteredCharacters(GetFilteredCharactersRequestDTO $dto): array
    {
        $filter = $dto->filter();
        $isValidFilter = $this->ensureBeValidFilter($filter);
        if (!$isValidFilter) {
            throw InvalidArgumentException::createFromMessage("Filter array not valid!");
        }

        return $this->service->findFilteredCharacters($filter);
    }

    private function ensureBeValidFilter(array $filter): bool
    {
        $isEmptyOrNull = empty($filter);
        $keysNotValid = !array_key_exists("status", $filter) && !array_key_exists("name", $filter);

        return $isEmptyOrNull || $keysNotValid;
    }

}