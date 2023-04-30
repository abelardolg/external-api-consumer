<?php

declare(strict_types=1);

namespace Clickcars\Infrastructure\Utils;

use Clickcars\Domain\Exceptions\InvalidArgumentException;
use Clickcars\Domain\Exceptions\NoDataFoundException;
use Clickcars\Domain\Mapper\RickAndMortyMapper;
use Clickcars\Domain\Utils\Utils;
use Clickcars\Domain\Validations\Validator;
use NickBeen\RickAndMortyPhpApi\Character;
use NickBeen\RickAndMortyPhpApi\Episode;
use NickBeen\RickAndMortyPhpApi\Exceptions\NotFoundException;

class RickAndMortyUtil
{
    private const LAST_CHARACTER_ID = 183;
    public const NUMBER_OF_CHARACTERS = 5;
    public const SEEN_IN_EPISODE = 0;

    public static function getEpisodeNumberFromEpisodeURL(string $episodeURL): int
    {
        return Utils::getCharacterId($episodeURL);
    }

    private static function generateXRandomNumbers(): array
    {
        $numbers = [];
        for ($i = 0; $i < self::NUMBER_OF_CHARACTERS; ++$i) {
            $numbers[] = mt_rand(1, self::LAST_CHARACTER_ID);
        }

        return $numbers;
    }

    public static function ensureGetXRandomIds(int $numberOfCharacters): array
    {
        do {
            $randomCharacterIds = self::generateXRandomNumbers();
            $randomCharacterIds = array_unique($randomCharacterIds);
            $thereAreXCharacters = count($randomCharacterIds) === $numberOfCharacters;
        } while (!$thereAreXCharacters);

        return $randomCharacterIds;
    }

    public static function toArray(array $data): array
    {
        $characterAPI = $data['characterAPI'];
        $episodeName = $data['episodeName'];

        return [
            'id' => $characterAPI->id,
            'status' => $characterAPI->status,
            'image' => $characterAPI->image,
            'name' => $characterAPI->name,
            'specie' => $characterAPI->species,
            'lastKnownLocation' => $characterAPI->location->name,
            'firstSeenIn' => $episodeName,
        ];
    }

    /**
     * @return object|array a Character object | array
     *
     * @throws NoDataFoundException
     */
    public static function getCharacters(): object|array
    {
        $characterProvider = new Character();
        $characterIds = self::ensureGetXRandomIds(self::NUMBER_OF_CHARACTERS);
        try {
            return $characterProvider->get(...$characterIds);
        } catch (NotFoundException) {
            throw NoDataFoundException::fromNoDataFound();
        }
    }

    /**
     * @throws NoDataFoundException
     */
    public static function getFilteredCharacters(array $filter): object|array
    {
        $character = new Character();
        if (isset($filter[Validator::STATUS_KEY])) {
            self::makeFilterByStatus($character, $filter[Validator::STATUS_KEY]);
        }

        if (isset($filter[Validator::NAME_KEY])) {
            self::makeFilterByName($character, $filter[Validator::NAME_KEY]);
        }

        try {
            return $character->get()->results;
        } catch (NotFoundException) {
            throw NoDataFoundException::fromNoFilteredCharactersFound();
        }
    }

    /**
     * @param object|array $characterAPI  a Character from API
     * @param int          $seenInEpisode a number of episode; by default is the first one
     *
     * @throws NoDataFoundException
     */
    public static function getEpisode(
        object|array $characterAPI,
        int $seenInEpisode = self::SEEN_IN_EPISODE): object|array
    {
        $episodes = $characterAPI->episode;
        $episodeNumber = self::getEpisodeNumberFromEpisodeURL($episodes[$seenInEpisode]);
        try {
            return (new Episode())->get($episodeNumber);
        } catch (NotFoundException) {
            throw NoDataFoundException::fromNoDataFound();
        }
    }

    /**
     * @throws InvalidArgumentException
     */
    private static function makeFilterByStatus(object $characterProvider, string $status): void
    {
        $statusAPI = RickAndMortyMapper::returnStatusByKey($status);
        $characterProvider->withStatus($statusAPI);
    }

    private static function makeFilterByName(object $characterProvider, string $name): void
    {
        $characterProvider->withName($name);
    }
}
