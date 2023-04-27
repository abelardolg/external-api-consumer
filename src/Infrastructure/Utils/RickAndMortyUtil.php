<?php

declare(strict_types=1);


namespace Clickcars\Infrastructure\Utils;

use Clickcars\Domain\Exceptions\InvalidArgumentException;
use Clickcars\Domain\Exceptions\NotFoundExceptionData;
use NickBeen\RickAndMortyPhpApi\Character;
use NickBeen\RickAndMortyPhpApi\Enums\Status;
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

    public static function ensureGetXRandomIds(int $numberOfCharacters): array
    {
        do {
            $randomCharacterIds = self::generateXRandomNumbers();
            $randomCharacterIds = array_unique($randomCharacterIds);
            $thereAreXCharacters = count($randomCharacterIds) === $numberOfCharacters;
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
     * @return object|array a Character object | array
     * @throws InvalidArgumentException|NotFoundException
     */
    public static function getCharacters(): object|array
    {
        $characterProvider = new Character();
        $characterIds = self::ensureGetXRandomIds(self::NUMBER_OF_CHARACTERS);
        return $characterProvider->get(...$characterIds);
    }

    /**
     * @throws NotFoundException
     */
    public static function getFilteredCharacters(array $filter): array
    {
        $characterProvider = new Character();
        $status = $filter[0];
        if (!empty($status)) {
            $characterProvider = $characterProvider->withStatus($status);
        }
        if (2 === count($filter)) {
            $name = $filter[1];
            $characterProvider = $characterProvider->withName($name);
        }

        return $characterProvider->get();
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