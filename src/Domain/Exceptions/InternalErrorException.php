<?php

declare(strict_types=1);

namespace Clickcars\Domain\Exceptions;

class InternalErrorException extends \Exception
{
    public static function createFromMessage(string $message): self
    {
        return new static($message);
    }
}
