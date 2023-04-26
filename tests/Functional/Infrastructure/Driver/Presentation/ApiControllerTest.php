<?php

declare(strict_types=1);


namespace Functional\Infrastructure\Driver\Presentation;

use Clickcars\Tests\Functional\Infrastructure\Driver\Presentation\ApiControllerTestBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiControllerTest extends ApiControllerTestBase
{
    private const GET_LIST_ENDPOINT = "/api/getCharacters";

    public function testWhenReturnsDataNotFound(): void
    {
        $this->client->request(Request::METHOD_GET, self::GET_LIST_ENDPOINT);

        $response = $this->client->getResponse();

        self::assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

}