<?php

declare(strict_types=1);

namespace Clickcars\Infrastructure\Driver\Presentation\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HealthCheckAPIController
{
    const API_UP_AND_RUNNING = "API up and running!";
    public function __invoke(): Response
    {
        return new JsonResponse(['message' => self::API_UP_AND_RUNNING]);
    }
}
