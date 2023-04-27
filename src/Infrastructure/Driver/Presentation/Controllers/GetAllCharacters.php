<?php

declare(strict_types=1);


namespace Clickcars\Infrastructure\Driver\Presentation\Controllers;

use Clickcars\Application\Driven\GetAllCharactersAPI;
use Clickcars\Application\Driven\ServiceAPI;
use Clickcars\Application\Driver\GetAllCharactersServiceAPI;
use Clickcars\Domain\Exceptions\InvalidArgumentException;
use Clickcars\Infrastructure\Driver\Presentation\DTOs\GetAllCharactersRequestDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class GetAllCharacters extends AbstractController
{

    public function __construct(private readonly GetAllCharactersAPI $service) {}

    public function getCharacters(): JsonResponse
    {
        try{
            $characters = $this->service->findAllCharacters();
            return new JsonResponse(["data" => $characters], Response::HTTP_OK);
        } catch(InvalidArgumentException $exception) {
            return new JsonResponse(["error" => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}