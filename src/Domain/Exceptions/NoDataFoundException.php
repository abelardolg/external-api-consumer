<?php

declare(strict_types=1);


namespace Clickcars\Domain\Exceptions;

use Exception;

class NoDataFoundException extends Exception
{
    private const NO_DATA_FOUND = "No data found!";
    private const NO_FILTERED_CHARACTERS_FOUND = "No data found from filters!";
    public static function fromNoDataFound(): self
    {
        return new static(self::NO_DATA_FOUND);
    }
    public static function fromNoFilteredCharactersFound(): self
    {
        return new static(self::NO_FILTERED_CHARACTERS_FOUND);
    }
}