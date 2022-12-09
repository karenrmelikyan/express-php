<?php

declare(strict_types=1);

namespace Core;

use Exception;
use React\Http\HttpServer;
use React\Socket\SocketServer;
use React\Http\Message\Response;
use Psr\Http\Message\ServerRequestInterface as ServerRequest;

final class Server
{
    public function __construct(private readonly string $serverHost = '127.0.0.1:8901')
    {
        //
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $http = new HttpServer(function (ServerRequest $serverRequest) {

            // extract data from ServerRequest
            $method = $serverRequest->getMethod();
            $route = $serverRequest->getUri()->getPath();

            if (!empty($p = $serverRequest->getQueryParams())) {
                $params = $p;
            } else {
                $params = [];
            }

            if (!empty($b = $serverRequest->getBody()->getContents())) {
                $body = json_decode($b, true, 512, JSON_THROW_ON_ERROR);
            } else {
                $body = [];
            }

            // create request
            $request = new Request(
                method: $method,
                route: $route,
                body: $body,
                params: $params,
            );

            try {
                $response = $this->kernel($request);
            } catch (Exception $e) {
                $response = $e->getMessage();
            }

            if (is_string($response)) {
                return Response::plaintext($response);
            }

            return Response::json($response);
        });

        $socket = new SocketServer($this->serverHost);
        $http->listen($socket);

        echo "Server listen host: $this->serverHost";
    }

    /**
     * @param Request $request
     * @return array|string|null
     * @throws Exception
     */
    private function kernel(Request $request): array|string|null
    {
        $result = null;
        $routeAllowed = true;
        $currentRoute = $request->getRoute();
        $currentMethod = $request->getMethod();

        $middlewares = require 'app/middlewares.php';
        $routes = require 'app/routes.php';

        foreach ($middlewares as $middleware) {
            if (in_array($currentRoute, $middleware['routes'], true)) {
                $routeAllowed = $middleware['function']($request);
                if (!is_bool($routeAllowed)) {
                    throw new \RuntimeException('ERROR: all middlewares should return only boolean type');
                }
            }
        }

        if ($routeAllowed) {
            if ($routes[$currentRoute]) {
                if ($routes[$currentRoute][$currentMethod]) {
                    $result = $routes[$currentRoute][$currentMethod]($request);
                    if (!(is_string($result) || is_array($result))) {
                        throw new \RuntimeException('ERROR: the route handler should return or array or string');
                    }
                } else {
                    throw new \RuntimeException('ERROR: it\'s seems like the method format is not correct or doesn\'t define');
                }
            } else {
                throw new \RuntimeException('ERROR: it\'s seems like the routes format is not correct or doesn\'t define');
            }
        } else {
            throw new \RuntimeException('ERROR: the route ' . $request->getRoute() . ' is restricted on middleware level or doesn\'t define');
        }

        return $result;
    }

}
