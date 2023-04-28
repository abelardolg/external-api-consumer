<?php

declare(strict_types=1);


namespace Clickcars\Domain\Validations;

use Clickcars\Domain\Mapper\RickAndMortyMapper;

class Validator
{
    const STATUS_KEY = "status";
    const NAME_KEY = "name";
    public static function ensureBeValidFilter(array $filter): bool
    {
        return isset($filter[self::STATUS_KEY]) || isset($filter[self::NAME_KEY]);
    }
    public static function ensureBeValidStatus(string $status): bool
    {
        $isEmptyOrNull = empty($status);
        $isKeyNotValid = RickAndMortyMapper::isStatusValid($status);

        return (!$isEmptyOrNull && !$isKeyNotValid);
    }

    public static function ensureBeValidName(string $name): bool
    {
        return !empty($name);
    }
}