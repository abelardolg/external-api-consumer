<?php

declare(strict_types=1);


namespace Clickcars\Domain\Utils;

class Utils
{
    public static function getCharacterId(string $url): int
    {
        $parseURLData = parse_url($url);
        $path = $parseURLData["path"];
        $dataFromURL = explode("/", $path);
        return (int) $dataFromURL[3];
    }
}