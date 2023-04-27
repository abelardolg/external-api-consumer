<?php

declare(strict_types=1);


namespace Clickcars\Application;

use Clickcars\Application\Driven\APIService;
use Clickcars\Application\Driver\Characters;
use Clickcars\Application\DTOs\CharacterDTO;
use Clickcars\Domain\Exceptions\InvalidArgumentException;

class GetCharacters implements Characters
{

    public function __construct(private readonly APIService $service) {}

    /**
     * @param CharacterDTO $characterDTO an object which contains useful information
     * @return array a Character collection
     */
    public function getCharacters(CharacterDTO $characterDTO): array
    {
        $parametersNotFound = $this->parametersNotFound($characterDTO->getFilter());
        if ($parametersNotFound) {
            throw InvalidArgumentException::createFromMessage("Filter array not found!");
        }

        return $this->service->getCharacters($characterDTO->getFilter());
    }

    private function parametersNotFound(array $filter): bool
    {
        return is_null($filter);
    }

}