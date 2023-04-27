<?php

declare(strict_types=1);

namespace Clickcars\Tests\Functional\Infrastructure\Driver\Presentation\Controllers;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetAllCharactersTest extends WebTestCase
{
    private const GET_LIST_ENDPOINT = "/api/getCharacters";

    public function testWhenInitialLoadOrWhenNotFilterIsProvided(): void
    {
        $client = static::createClient();
        $NO_FILTERS_ARE_PROVIDED = [
            "filter" => []
        ];
        $NUMBER_OF_CHARACTERS = 5;
        $client->request(
            Request::METHOD_GET,
            self::GET_LIST_ENDPOINT,
            [],
            [],
            array('CONTENT_TYPE' => 'application/json'),
            json_encode($NO_FILTERS_ARE_PROVIDED)
        );

        $response = $client->getResponse();
        $responseData = $this->getResponseData($response);
        $characters = $responseData["data"];

        self::assertArrayHasKey("data", $responseData);
        self::assertCount($NUMBER_OF_CHARACTERS, $characters);
        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $client = null;
    }

    private function getResponseData(Response $response): array
    {
        return json_decode($response->getContent(), true);
    }

}