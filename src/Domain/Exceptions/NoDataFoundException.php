<?php

declare(strict_types=1);


namespace Clickcars\Domain\Exceptions;

use Exception;

class NoDataFoundException extends Exception
{
    private const NO_DATA_FOUND = "No data found!";
    public static function fromNoDataFound(): self
    {
        return new static(self::NO_DATA_FOUND);
    }
}