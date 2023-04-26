<?php

declare(strict_types=1);

namespace Clickcars\Tests\Functional\Infrastructure\Driver\Presentation;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\HttpFoundation\Response;

class ApiControllerTestBase extends WebTestCase
{
    const ENDPOINT = "/api/health-check";
    protected ?AbstractBrowser $client;

    public function setUp(): void
    {
        $this->client = static::createClient();
        $this->client->setServerParameter("CONTENT_TYPE", "application/json");
    }
    public function tearDown(): void
    {
        $this->client = null;
    }

    protected function getResponseData(Response $response): array
    {
        return json_decode($response->getContent(), true);
    }
}