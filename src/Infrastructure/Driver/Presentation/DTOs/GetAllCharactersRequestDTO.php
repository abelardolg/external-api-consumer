<?php

declare(strict_types=1);

namespace Clickcars\Infrastructure\Driver\Presentation\DTOs;

use Symfony\Component\HttpFoundation\Request;

final class GetAllCharactersRequestDTO implements RequestDTO
{
    public function __construct(Request $request)
    {
    }
}
