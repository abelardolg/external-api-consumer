<?php

declare(strict_types=1);


namespace Clickcars\Tests\Functional\Infrastructure\Driver\Presentation\Controllers;

use Clickcars\Infrastructure\Utils\RickAndMortyUtil;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetFilteredCharactersTest extends WebTestCase
{
    private const GET_LIST_ENDPOINT = "/api/getFilteredCharacters";

    public function testWhenFilterIsNotProvided(): void
    {
        $client = static::createClient();

        $FILTER_NOT_PROVIDED = "{}";
        $client->request(
            Request::METHOD_GET,
            self::GET_LIST_ENDPOINT,
            [],
            [],
            array('CONTENT_TYPE' => 'application/json'),
            $FILTER_NOT_PROVIDED
        );

        $response = $client->getResponse();

        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
    }

    public function testWhenBadRequest(): void
    {
        $client = static::createClient();

        $FILTER_PROVIDED = "{
            \"filter\": []
        }";
        $client->request(
            Request::METHOD_GET,
            self::GET_LIST_ENDPOINT,
            [],
            [],
            array('CONTENT_TYPE' => 'application/json'),
            $FILTER_PROVIDED
        );

        $response = $client->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());

        $client = null;
    }

    public function testWhenFilterIsEmpty(): void
    {
        $client = static::createClient();

        $FILTER_PROVIDED = "{
            \"filter\": {}
        }";
        $client->request(
            Request::METHOD_GET,
            self::GET_LIST_ENDPOINT,
            [],
            [],
            array('CONTENT_TYPE' => 'application/json'),
            $FILTER_PROVIDED
        );

        $response = $client->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());

        $client = null;
    }

    public function testWhenStatusNotValid(): void
    {
        $client = static::createClient();

        $FILTER_PROVIDED = "{
            \"filter\": {
                \"status\": \"wrongValue\"
            }
        }";
        $client->request(
            Request::METHOD_GET,
            self::GET_LIST_ENDPOINT,
            [],
            [],
            array('CONTENT_TYPE' => 'application/json'),
            $FILTER_PROVIDED
        );

        $response = $client->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());

        $client = null;
    }

    public function testWhenStatusIsValid(): void
    {
        $client = static::createClient();

        $FILTER_PROVIDED = "{
            \"filter\": {
                \"status\": \"dead\"
            }
        }";
        $client->request(
            Request::METHOD_GET,
            self::GET_LIST_ENDPOINT,
            [],
            [],
            array('CONTENT_TYPE' => 'application/json'),
            $FILTER_PROVIDED
        );

        $response = $client->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertCount(RickAndMortyUtil::NUMBER_OF_CHARACTERS, $responseData["data"]);

        $client = null;
    }

    public function testWhenNameIsProvided(): void
    {
        $client = static::createClient();

        $FILTER_PROVIDED = "{
            \"filter\": {
                \"name\": \"a\"
            }
        }";
        $client->request(
            Request::METHOD_GET,
            self::GET_LIST_ENDPOINT,
            [],
            [],
            array('CONTENT_TYPE' => 'application/json'),
            $FILTER_PROVIDED
        );

        $response = $client->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertCount(RickAndMortyUtil::NUMBER_OF_CHARACTERS, $responseData["data"]);

        $client = null;
    }

    private function getResponseData(Response $response): array
    {
        return json_decode($response->getContent(), true);
    }

}