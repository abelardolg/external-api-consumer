<?php

declare(strict_types=1);


namespace Functional\Clickcars\Infrastructure\Driver\Presentation;

use Clickcars\Infrastructure\Driver\Presentation\HealthCheckAPIController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HealthCheckAPIControllerTest extends WebTestCase
{

    private const ENDPOINT = "/api/health-check";

    public function testHealthCheckAPI(): void
    {
        $client = static::createClient();
        $client->setServerParameter("CONTENT_TYPE", "application/json");

        $client->request(Request::METHOD_GET, self::ENDPOINT);

        $response = $client->getResponse();
        $responseData = json_decode($response->getContent(), true);

        self::assertArrayHasKey("message", $responseData, "It contains a 'message' key");
        self::assertEquals(HealthCheckAPIController::API_UP_AND_RUNNING, $responseData["message"]);
        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());

    }
}