<?php

declare(strict_types=1);


namespace Clickcars\Application\Driven;

interface APIService
{
    public function getCharacters(array $filter): array;
}