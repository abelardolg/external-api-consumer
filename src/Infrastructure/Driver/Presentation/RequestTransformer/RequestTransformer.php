<?php

declare(strict_types=1);


namespace Clickcars\Infrastructure\Driver\Presentation\RequestTransformer;

use Clickcars\Domain\Exceptions\InvalidArgumentException;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use function in_array;

class RequestTransformer
{
    private const ALLOWED_CONTENT_TYPE = 'application/json';

    private const METHODS_TO_DECODE = [Request::METHOD_GET];

    public function transform(Request $request): void
    {
        if (self::ALLOWED_CONTENT_TYPE !== $request->headers->get('Content-Type')) {
            throw InvalidArgumentException::createFromMessage(\sprintf('[%s] is the only Content-Type allowed', self::ALLOWED_CONTENT_TYPE));
        }

        if (\in_array($request->getMethod(), self::METHODS_TO_DECODE, true)) {
            try {
                $request->request = new ParameterBag(\json_decode(
                    $request->getContent(), true, 512, \JSON_THROW_ON_ERROR)
                );
            } catch (\JsonException) {
                throw InvalidArgumentException::createFromMessage('Invalid JSON payload');
            }
        }
    }
}