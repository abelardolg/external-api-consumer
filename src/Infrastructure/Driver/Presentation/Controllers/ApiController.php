<?php

declare(strict_types=1);


namespace Clickcars\Infrastructure\Driver\Presentation\Controllers;

use Clickcars\Domain\Exceptions\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use Clickcars\Application\Driver\Characters;
use Clickcars\Application\DTOs\Character;
use Clickcars\Domain\Exceptions\InternalErrorException;
use Clickcars\Infrastructure\Driver\Presentation\DTOs\GetCharactersRequestDTO;

class ApiController extends AbstractController
{

    public function __construct(private readonly Characters $service) {}

    public function getCharacters(GetCharactersRequestDTO $request): JsonResponse
    {
        try{
            $characterRequest = Character::fromFilter($request->filter());
            $characters = $this->service->getCharacters($characterRequest);
            return new JsonResponse(["data" => $characters], Response::HTTP_OK);
        } catch(InvalidArgumentException $exception) {
            return new JsonResponse(["error" => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}