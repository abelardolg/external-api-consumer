<?php

declare(strict_types=1);


namespace Clickcars\Domain\Exceptions;

use InvalidArgumentException as NativeInvalidArgumentException;

class InvalidArgumentException extends NativeInvalidArgumentException
{
    private const NAME_NOT_VALID = "Name not valid!";
    private const STATUS_NOT_VALID = "%s is not a status valid!";
    private const FILTER_NOT_VALID = "Filter not valid!";
    private const CONTENT_ALLOWED = '[%s] is the only Content-Type allowed';

    public static function createFromNameNotValid(): self
    {
        return new static(self::NAME_NOT_VALID);
    }

    public static function createFromStatusNotValid(string $wrongStatus): self
    {
        $msg = \sprintf(self::STATUS_NOT_VALID, $wrongStatus);
        return new static($msg);
    }
    public static function createFromFilterNotValid(): self
    {
        return new static(self::FILTER_NOT_VALID);
    }

    public static function createFromContentTypeNotAllowed(string $contentAllowed): self
    {
        $msg = \sprintf(self::CONTENT_ALLOWED,$contentAllowed);
        return new static($msg);
    }

    public static function createFromInvalidJSONPayload(string $invalidJSONPayload): self
    {
        return new static($invalidJSONPayload);
    }
}