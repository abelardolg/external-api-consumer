<?php

declare(strict_types=1);


namespace Clickcars\Infrastructure\Utils;

use Clickcars\Domain\Exceptions\NotFoundExceptionData;
use NickBeen\RickAndMortyPhpApi\Character;
use NickBeen\RickAndMortyPhpApi\Episode;
use NickBeen\RickAndMortyPhpApi\Exceptions\NotFoundException;

class RickAndMortyUtil
{
    private const LAST_CHARACTER_ID = 183;
     const NUMBER_OF_CHARACTERS = 5;
    const SEEN_IN_EPISODE = 0;
    public static function getEpisodeNumberFromEpisodeURL(string $episodeURL):int
    {
        $dataFromURL = explode("/", $episodeURL);
        return (int) $dataFromURL[count($dataFromURL)-1];
    }
    private static function generateXRandomNumbers(): array
    {
        $numbers = [];
        for($i = 0; $i < self::NUMBER_OF_CHARACTERS; $i++) {
            $numbers[] = rand(1, self::LAST_CHARACTER_ID);
        }
        return $numbers;
    }

    public static function ensureGetXRandomIds(): array
    {
        do {
            $randomCharacterIds = self::generateXRandomNumbers();
            $randomCharacterIds = array_unique($randomCharacterIds);
            $thereAreXCharacters = count($randomCharacterIds) === self::NUMBER_OF_CHARACTERS;
        } while(!$thereAreXCharacters);

        return $randomCharacterIds;
    }

    public static function toArray(array $data): array
    {
        $characterAPI = $data["characterAPI"];
        $episodeName = $data["episodeName"];

        return [
            "image" => $characterAPI->image,
            "name" => $characterAPI->name,
            "specie" => $characterAPI->species,
            "lastKnownLocation" => $characterAPI->location->name,
            "firstSeenIn" => $episodeName
        ];
    }

    /**
     * @param array $filter a filter criteria; by default is empty
     * @return object|array a Character object | array
     * @throws NotFoundException
     */
    public static function getCharacterByFilter(array $filter = []): object|array
    {
        if (0 === count($filter)) {
            $characterProvider = new Character();
            $characterIds = self::ensureGetXRandomIds();
            return $characterProvider->get(...$characterIds);
        }
        // To be implemented by filtering
        return  [];
    }

    /**
     * @param object|array $characterAPI a Character from API
     * @param int $seenInEpisode a number of episode; by default is the first one.
     * @throws NotFoundExceptionData
     */
    public static function getEpisode(
        object|array $characterAPI,
        int $seenInEpisode = self::SEEN_IN_EPISODE):object|array
    {
        $episodes = $characterAPI->episode;
        $episodeNumber = self::getEpisodeNumberFromEpisodeURL($episodes[$seenInEpisode]);
        try {
            return (new Episode())->get($episodeNumber);
        } catch(NotFoundException) {
            throw NotFoundExceptionData::fromMessage();
        }
    }

}