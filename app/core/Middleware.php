<?php

declare(strict_types=1);

namespace App\Core;

use JetBrains\PhpStorm\ArrayShape;

final class Middleware
{
    #[ArrayShape(['routes' => "array", 'func_result' => "mixed"])]
    public static function checkRoutes(array $routes, callable $foo): array
    {
        return [
            'routes' => $routes,
            'func_result' => $foo(),
        ];
    }
}