<?php

declare(strict_types=1);


namespace Clickcars\Infrastructure\Driven;

use Clickcars\Domain\Driven\CharactersProvider;
use Clickcars\Domain\Exceptions\NotFoundExceptionData;
use Clickcars\Infrastructure\Utils\RickAndMortyUtil;
use NickBeen\RickAndMortyPhpApi\Api;
use NickBeen\RickAndMortyPhpApi\Episode;
use NickBeen\RickAndMortyPhpApi\Exceptions\NotFoundException;

class RickAndMortyProvider implements CharactersProvider
{
    private readonly Api $api;

    public function __construct() {
        $this->api = new Api();
    }

    /**
     * @param array $filter a filter criteria; by default is empty
     * @returns array a Character collection potentially filtered
     * @throws NotFoundExceptionData
     */
    public function getCharacters(array $filter): array {
        try {
            $charactersAPI = RickAndMortyUtil::getCharacterByFilter($filter);
            $characters = [];
            foreach($charactersAPI as $characterAPI) {
                $toArrayOptions = [
                    "characterAPI" => $characterAPI,
                    "episodeName" => RickAndMortyUtil::getEpisode($characterAPI)->name
                ];
                $characters[] = RickAndMortyUtil::toArray($toArrayOptions);
            }
        } catch(NotFoundException) {
            throw NotFoundExceptionData::fromMessage();
        }

        return $characters;
    }

}