<?php

declare(strict_types=1);


namespace Clickcars\Application;

use Clickcars\Application\Driven\GetFilteredCharactersAPI;
use Clickcars\Domain\Exceptions\InvalidArgumentException;
use Clickcars\Domain\RickAndMortyAPIService;
use Clickcars\Domain\Validations\Validator;
use Clickcars\Infrastructure\Driver\Presentation\DTOs\GetFilteredCharactersRequestDTO;

class GetFilteredCharacters implements GetFilteredCharactersAPI
{

    public function __construct(private readonly RickAndMortyAPIService $service) {}

    /**
     * @param GetFilteredCharactersRequestDTO $dto an object which contains useful information
     * @return array a Character collection
     */
    public function findFilteredCharacters(GetFilteredCharactersRequestDTO $dto): array
    {

        $filter = $dto->filter();

        $isValidFilter = Validator::ensureBeValidFilter($filter);
        if (!$isValidFilter) {
            throw InvalidArgumentException::createFromMessage("Filter array not valid!");
        }

        if (isset($filter["status"])) {
            $isValidStatus = Validator::ensureBeValidStatus($filter["status"]);
            if (!$isValidStatus) {
                throw InvalidArgumentException::createFromMessage("Status not valid!");
            }
        }

        if (isset($filter["name"])) {
            $isValidName = Validator::ensureBeValidName($filter["name"]);
            if (!$isValidName) {
                throw InvalidArgumentException::createFromMessage("Name not valid!");
            }
        }

        return $this->service->findFilteredCharacters($filter);
    }


}