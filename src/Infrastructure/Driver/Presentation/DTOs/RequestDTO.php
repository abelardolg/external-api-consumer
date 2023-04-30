<?php

namespace Clickcars\Infrastructure\Driver\Presentation\DTOs;

use Symfony\Component\HttpFoundation\Request;

interface RequestDTO
{
    public function __construct(Request $request);
}
