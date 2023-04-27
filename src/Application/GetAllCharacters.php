<?php

declare(strict_types=1);


namespace Clickcars\Application;

use Clickcars\Application\Driven\GetAllCharactersAPI;
use Clickcars\Application\Driver\GetAllCharactersServiceAPI;

class GetAllCharacters implements GetAllCharactersAPI
{

    public function __construct(private readonly GetAllCharactersServiceAPI $service) {}

    /**
     * @return array a Character collection
     */
    public function findAllCharacters(): array
    {
        return $this->service->findAllCharacters();
    }

}