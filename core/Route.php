<?php

declare(strict_types=1);

namespace Core;

final class Route
{
    /**
     * @param string $uri
     * @param callable $foo
     * @return array[][]
     */
    public static function get(string $uri, callable $foo): array
    {
        return [
            $uri => [
                'GET' => [
                    'func_result' => &$foo,
                ]
            ],
        ];
    }

    /**
     * @param string $uri
     * @param callable $foo
     * @return array[][]
     */
    public static function post(string $uri, callable $foo): array
    {
        return [
            $uri => [
                'POST' => [
                    'func_result' => &$foo,
                ]
            ],
        ];
    }

    /**
     * @param string $uri
     * @param callable $foo
     * @return array[][]
     */
    public static function put(string $uri, callable $foo): array
    {
        return [
            $uri => [
                'PUT' => [
                    'func_result' => &$foo,
                ]
            ],
        ];
    }

    /**
     * @param string $uri
     * @param callable $foo
     * @return array[][]
     */
    public static function delete(string $uri, callable $foo): array
    {
        return [
            $uri => [
                'DELETE' => [
                    'func_result' => &$foo,
                ]
            ],
        ];
    }
}