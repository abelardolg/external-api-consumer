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
            throw InvalidArgumentException::createFromFilterNotValid();
        }

        if (isset($filter[Validator::STATUS_KEY])) {
            $isValidStatus = Validator::ensureBeValidStatus($filter[Validator::STATUS_KEY]);
            if (!$isValidStatus) {
                throw InvalidArgumentException::createFromStatusNotValid($filter[Validator::STATUS_KEY]);
            }
        }

        if (isset($filter[Validator::NAME_KEY])) {
            $isValidName = Validator::ensureBeValidName($filter[Validator::NAME_KEY]);
            if (!$isValidName) {
                throw InvalidArgumentException::createFromNameNotValid();
            }
        }

        return $this->service->findFilteredCharacters($filter);
    }

}