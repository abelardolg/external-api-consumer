<?php

declare(strict_types=1);


namespace Clickcars\Domain\Mapper;

use NickBeen\RickAndMortyPhpApi\Enums\Status;

class RickAndMortyMapper
{
    public static function isStatusValid(string $statusValue): bool
    {
        $STATUS_MAPPER = self::getStatusMapper();
        return !array_key_exists($statusValue, $STATUS_MAPPER);
    }

    public static function returnStatusByKey(string $key): Status
    {
        $STATUS_MAPPER = self::getStatusMapper();
        return $STATUS_MAPPER[$key];
    }

    private static function getStatusMapper(): array
    {
        return [
            "dead" => Status::DEAD(),
            "alive" => Status::ALIVE(),
            "unknown" => Status::UNKNOWN()
        ];
    }
}