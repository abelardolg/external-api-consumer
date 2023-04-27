<?php

declare(strict_types=1);


namespace Clickcars\Infrastructure\Driven;

use Clickcars\Domain\Driven\CharactersProvider;
use Clickcars\Domain\Exceptions\InvalidArgumentException;
use Clickcars\Domain\Exceptions\NotFoundExceptionData;
use Clickcars\Infrastructure\Utils\RickAndMortyUtil;
use NickBeen\RickAndMortyPhpApi\Api;
use NickBeen\RickAndMortyPhpApi\Exceptions\NotFoundException;

class RickAndMortyProvider implements CharactersProvider
{
    private readonly Api $api;

    public function __construct() {
        $this->api = new Api();
    }

    /**
     * @return array a Character collection
     * @throws NotFoundExceptionData
     */
    public function findByFilter(array $filter): array
    {
        try {
            $charactersAPI = RickAndMortyUtil::getFilteredCharacters($filter);
            $characters = $this->charactersMapper($charactersAPI);
        } catch(NotFoundException) {
            throw NotFoundExceptionData::fromMessage();
        }

        return $characters;
    }

    /**
     * @return array a Character collection
     * @throws NotFoundExceptionData
     */
    public function findAllCharacters(): array {
        try {
            $charactersAPI = RickAndMortyUtil::getCharacters();
            $characters = $this->charactersMapper($charactersAPI);
        } catch(NotFoundException) {
            throw NotFoundExceptionData::fromMessage();
        }

        return $characters;
    }

    /**
     * @throws NotFoundExceptionData
     */
    private function charactersMapper(object|array $charactersAPI): array
    {
        $characters = [];
        foreach($charactersAPI as $characterAPI) {
            $toArrayOptions = [
                "characterAPI" => $characterAPI,
                "episodeName" => RickAndMortyUtil::getEpisode($characterAPI)->name
            ];
            $characters[] = RickAndMortyUtil::toArray($toArrayOptions);
        }
        return $characters;
    }
}