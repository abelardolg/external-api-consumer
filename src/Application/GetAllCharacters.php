<?php

declare(strict_types=1);


namespace Clickcars\Application;

use Clickcars\Application\Driven\GetAllCharactersAPI;
use Clickcars\Application\Driver\GetAllCharactersServiceAPI;
use Clickcars\Domain\Exceptions\NoDataFoundException;

class GetAllCharacters implements GetAllCharactersAPI
{

    public function __construct(private readonly GetAllCharactersServiceAPI $service) {}

    /**
     * @return array a Character collection
     * @throws NoDataFoundException
     */
    public function findAllCharacters(): array
    {
        return $this->service->findAllCharacters();
    }

}