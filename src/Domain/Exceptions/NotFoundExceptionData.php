<?php

declare(strict_types=1);


namespace Clickcars\Domain\Exceptions;

use Exception;

class NotFoundExceptionData extends Exception
{
    private const INTERNAL_SERVER_ERROR = "Internal Server Error";
    public static function fromMessage(): self
    {
        return new static(self::INTERNAL_SERVER_ERROR);
    }
}