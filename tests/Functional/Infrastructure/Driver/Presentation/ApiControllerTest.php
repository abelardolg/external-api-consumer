<?php

declare(strict_types=1);


namespace Functional\Infrastructure\Driver\Presentation;

use Clickcars\Tests\Functional\Infrastructure\Driver\Presentation\ApiControllerTestBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiControllerTest extends ApiControllerTestBase
{
    private const GET_LIST_ENDPOINT = "/api/getCharacters";

    public function testWhenReturnsServerInternalError(): void
    {
        $this->client->request(Request::METHOD_GET, self::GET_LIST_ENDPOINT);

        $response = $this->client->getResponse();

        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
    }

    public function testWhenReturnsEmptyData(): void
    {
        $this->client->request(Request::METHOD_GET, self::GET_LIST_ENDPOINT);

        $response = $this->client->getResponse();
        $responseData = $this->getResponseData($response);


        self::assertArrayHasKey("data", $responseData);
        self::assertEquals([], $responseData["data"]);
        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }


}