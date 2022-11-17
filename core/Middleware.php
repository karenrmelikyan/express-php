<?php

declare(strict_types=1);

namespace Core;

final class Middleware
{
    public static function checkRoutes(array $routes, callable $foo): array
    {
        return [
            'routes' => $routes,
            'func_result' => &$foo,
        ];
    }
}