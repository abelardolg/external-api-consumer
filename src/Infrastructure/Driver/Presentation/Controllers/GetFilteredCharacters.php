<?php

declare(strict_types=1);


namespace Clickcars\Infrastructure\Driver\Presentation\Controllers;

use Clickcars\Application\Driven\GetFilteredCharactersAPI;
use Clickcars\Domain\Exceptions\InvalidArgumentException;
use Clickcars\Infrastructure\Driver\Presentation\DTOs\GetFilteredCharactersRequestDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class GetFilteredCharacters extends AbstractController
{

    public function __construct(private readonly GetFilteredCharactersAPI $service) {}

    public function getFilteredCharacters(GetFilteredCharactersRequestDTO $request): JsonResponse
    {
        try{
            $characters = $this->service->findFilteredCharacters($request);
            return new JsonResponse(["data" => $characters], Response::HTTP_OK);
        } catch(InvalidArgumentException $exception) {
            return new JsonResponse(["error" => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}