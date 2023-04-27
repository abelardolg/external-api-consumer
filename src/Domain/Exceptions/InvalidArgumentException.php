<?php

declare(strict_types=1);


namespace Clickcars\Domain\Exceptions;

use InvalidArgumentException as NativeInvalidArgumentException;

class InvalidArgumentException extends NativeInvalidArgumentException
{
    public static function createFromMessage(string $message): self
    {
        return new static($message);
    }
}