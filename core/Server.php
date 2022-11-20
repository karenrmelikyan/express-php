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
    public function __construct(private string $serverHost = '127.0.0.1:8901')
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
     * return either an array or throw
     * exception with an appropriate message
     *
     * @param Request $request
     * @return array
     * @throws Exception
     */
    private function kernel(Request $request): array|string
    {
        $result = null;

        $currentRoute = $request->getRoute();
        $currentMethod = $request->getMethod();

        foreach (require 'app/routes.php' as $route) {
            if (isset($route[$currentRoute][$currentMethod])) {

                foreach (require 'app/middlewares.php' as $middleware) {
                    foreach ($middleware['routes'] as $middlewareRoute) {
                        if (($middlewareRoute === $currentRoute) && !$middleware['func_result']($request)) {
                            throw new \RuntimeException("WARNING! Runtime Exception was thrown!\n
                            MESSAGE: Forbidden handling of the route $currentRoute by middleware\n");
                        }
                    }
                }

                $result = $route[$currentRoute][$currentMethod]['func_result']($request);

                if (is_array($result) || is_string($result)) {
                    return $result;
                }

                throw new \RuntimeException(
                    "WARNING! Runtime Exception was thrown. \nMESSAGE: Your {$currentRoute}" .
                    "route handler function for {$currentMethod} method, should return either data array or string\n"
                );
            }

        }

        if (!$result) {
            throw new \RuntimeException(
                "WARNING! Runtime Exception was thrown!\nMESSAGE: The route {$currentRoute} doesn't define\n"
            );
        }

        return $result;
    }

}
