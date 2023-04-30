<?php

declare(strict_types=1);

namespace Clickcars\Infrastructure\Driver\Presentation\RequestTransformer;

use Clickcars\Domain\Exceptions\InvalidArgumentException;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class RequestTransformer
{
    private const ALLOWED_CONTENT_TYPE = 'application/json';
    private const INVALID_JSON_PAYLOAD = 'Invalid JSON payload';

    private const METHODS_TO_DECODE = [Request::METHOD_POST];

    public function transform(Request $request): void
    {
        if (self::ALLOWED_CONTENT_TYPE !== $request->headers->get('Content-Type')) {
            throw InvalidArgumentException::createFromContentTypeNotAllowed(self::ALLOWED_CONTENT_TYPE);
        }

        if (\in_array($request->getMethod(), self::METHODS_TO_DECODE, true)) {
            try {
                $request->request = new ParameterBag(\json_decode(
                    $request->getContent(), true, 512, \JSON_THROW_ON_ERROR)
                );
            } catch (\JsonException) {
                throw InvalidArgumentException::createFromInvalidJSONPayload(self::INVALID_JSON_PAYLOAD);
            }
        }
    }
}
