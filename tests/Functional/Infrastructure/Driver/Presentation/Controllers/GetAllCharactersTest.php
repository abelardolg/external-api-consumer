<?php

declare(strict_types=1);


namespace Clickcars\Tests\Functional\Infrastructure\Driver\Presentation\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetAllCharactersTest extends ApiControllerTestBase
{
    private const GET_LIST_ENDPOINT = "/api/getCharacters";

    public function testWhenReturnsServerInternalError(): void
    {
        $this->client->request(Request::METHOD_GET, self::GET_LIST_ENDPOINT);

        $response = $this->client->getResponse();

        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
    }

    public function testWhenReturnsBadRequestError(): void
    {
        $this->client->request(Request::METHOD_GET, self::GET_LIST_ENDPOINT);

        $response = $this->client->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testWhenInitialLoadOrWhenNotFilterIsProvided(): void
    {
        $NO_FILTERS_ARE_PROVIDED = [
            "filter" => []
        ];
        $NUMBER_OF_CHARACTERS = 5;
        $this->client->request(
            Request::METHOD_GET,
            self::GET_LIST_ENDPOINT,
            [],
            [],
            array('CONTENT_TYPE' => 'application/json'),
            json_encode($NO_FILTERS_ARE_PROVIDED)
        );

        $response = $this->client->getResponse();
        $responseData = $this->getResponseData($response);
        $characters = $responseData["data"];

        self::assertArrayHasKey("data", $responseData);
        self::assertCount($NUMBER_OF_CHARACTERS, $characters);
        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }


}