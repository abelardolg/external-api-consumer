<?php

declare(strict_types=1);


namespace Clickcars\Infrastructure\Driven;

use Clickcars\Domain\Driven\CharactersProvider;
use Clickcars\Domain\Exceptions\NoDataFoundException;
use Clickcars\Infrastructure\Utils\RickAndMortyUtil;
use NickBeen\RickAndMortyPhpApi\Exceptions\NotFoundException;

class RickAndMortyProvider implements CharactersProvider
{
    /**
     * @return array a Character collection
     * @throws NoDataFoundException
     */
    public function findByFilter(array $filter): array
    {
        
        try {
            $charactersAPI = RickAndMortyUtil::getFilteredCharacters($filter);

            $characters = $this->charactersMapper($charactersAPI);
        } catch(NotFoundException) {
            throw NoDataFoundException::fromNoDataFound();
        }

        return $characters;
    }

    /**
     * @return array a Character collection
     * @throws NoDataFoundException
     */
    public function findAllCharacters(): array {
        $charactersAPI = RickAndMortyUtil::getCharacters();
        return $this->charactersMapper($charactersAPI);
    }

    /**
     * @throws NoDataFoundException
     */
    private function charactersMapper(object|array $charactersAPI): array
    {
        $characters = [];
        $max_number_characters = min(count($charactersAPI), RickAndMortyUtil::NUMBER_OF_CHARACTERS);
        for($i=0; $i<$max_number_characters; $i++) {
            $characterAPI = $charactersAPI[$i];
            $episode = RickAndMortyUtil::getEpisode($characterAPI);
            $toArrayOptions = [
                "characterAPI" => $characterAPI,
                "episodeName" => $episode->name
            ];
            $characters[] = RickAndMortyUtil::toArray($toArrayOptions);

        }
       // var_dump($characters);
        return $characters;
    }
}