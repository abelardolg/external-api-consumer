<?php

declare(strict_types=1);


namespace Clickcars\Domain\Validations;

use Clickcars\Domain\Mapper\RickAndMortyMapper;

class Validator
{

    public static function ensureBeValidFilter(array $filter): bool
    {
        return isset($filter["status"]) || isset($filter["name"]);
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