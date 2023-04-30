<?php

declare(strict_types=1);

namespace Clickcars\Tests\Functional\Infrastructure\Driver\Presentation\Controllers;

use Clickcars\Infrastructure\Driver\Presentation\Controllers\HealthCheckAPIController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class HealthCheckAPIControllerTest extends ApiControllerTestBase
{
    public function testHealthCheckAPI(): void
    {
        $this->client->request(Request::METHOD_GET, self::ENDPOINT);

        $response = $this->client->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertArrayHasKey('message', $responseData, "It contains a 'message' key");
        self::assertEquals(HealthCheckAPIController::API_UP_AND_RUNNING, $responseData['message']);
        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
