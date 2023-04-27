<?php

declare(strict_types=1);


namespace Clickcars\Domain;

use Clickcars\Application\Driven\APIService;
use Clickcars\Application\DTOs\CharacterDTO;
use Clickcars\Domain\Driven\CharactersProvider;

class RickAndMortyAPIService implements APIService
{
    public function __construct(private readonly CharactersProvider $dataProvider) {}
    public function getCharacters(array $filter): array
    {
        return $this->dataProvider->getCharacters($filter);
    }

}