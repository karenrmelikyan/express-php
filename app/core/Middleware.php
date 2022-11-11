<?php declare(strict_types=1);

namespace App\Core;

final class Middleware
{
    public static function beforeRoutes(array $routes, callable $foo): bool
    {
        return $foo();
    }

    public static function afterRoutes(array $routes, callable $foo): bool
    {
        return $foo();
    }

}