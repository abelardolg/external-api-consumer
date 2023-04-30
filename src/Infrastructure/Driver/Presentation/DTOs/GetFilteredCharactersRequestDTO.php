<?php

declare(strict_types=1);

namespace Clickcars\Infrastructure\Driver\Presentation\DTOs;

use Symfony\Component\HttpFoundation\Request;

final class GetFilteredCharactersRequestDTO implements RequestDTO
{
    private ?array $filter;

    public function __construct(Request $request)
    {
        $this->filter = $request->request->get('filter');
    }

    public function filter(): ?array
    {
        return $this->filter;
    }
}
