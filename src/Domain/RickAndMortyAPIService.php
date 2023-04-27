<?php

declare(strict_types=1);


namespace Clickcars\Domain;

use Clickcars\Application\Driver\GetAllCharactersServiceAPI;
use Clickcars\Application\Driver\GetFilteredCharactersServiceAPI;
use Clickcars\Domain\Driven\CharactersProvider;
use Clickcars\Domain\Exceptions\NoDataFoundException;

class RickAndMortyAPIService implements GetAllCharactersServiceAPI, GetFilteredCharactersServiceAPI
{
    public function __construct(private readonly CharactersProvider $dataProvider) {}

    /**
     * @throws NoDataFoundException
     */
    public function findAllCharacters(): array
    {
        return $this->dataProvider->findAllCharacters();
    }

    public function findFilteredCharacters(array $filter): array
    {
        return $this->dataProvider->findByFilter($filter);
    }
}