<?php

declare(strict_types=1);


namespace Clickcars\Infrastructure\Driver\Presentation;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController
{

    public function getCharacters(Request $request): JsonResponse
    {
        return new JsonResponse(["data" => []], Response::HTTP_OK);
    }
}