<?php

declare(strict_types=1);

namespace App\Core;

use Exception;
use React\Http\HttpServer;
use React\Socket\SocketServer;
use React\Http\Message\Response;
use Psr\Http\Message\ServerRequestInterface as ServerRequest;

final class Server
{
    private string $serverHost;

    private string $dbHost;
    private string $dbName;
    private string $dbUsername;
    private string $dbPassword;

    private string $route;
    private string $method;
    private array  $body;
    private array  $params;

    /**
     * @param string $host
     * @return $this
     */
    public function setServerHost(string $host = '127.0.0.1:8901'): self
    {
        $this->serverHost = $host;
        return $this;
    }

    /**
     * @param string $host
     * @return $this
     */
    public function setDBHost(string $host = '3306'): self
    {
        $this->dbHost = $host;
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setDBName(string $name = 'database'): self
    {
        $this->dbName = $name;
        return $this;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setDBUserName(string $username = 'root'): self
    {
        $this->dbUsername = $username;
        return $this;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setDBPassword(string $password = 'root'): self
    {
        $this->dbPassword = $password;
        return $this;
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $http = new HttpServer(function (ServerRequest $serverRequest) {
            $this->method = $serverRequest->getMethod();
            $this->route = $serverRequest->getUri()->getPath();
            $this->params = $serverRequest->getQueryParams();
            $this->body = json_decode($serverRequest->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

            $request = new Request();
            $request->setMethod($this->method);
            $request->setRoute($this->route);
            $request->setParams($this->params);
            $request->setBody($this->body);

            $response = [];

            try {
                $response = $this->kernel($request);
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            return Response::json($response);
        });

        $socket = new SocketServer($this->serverHost);
        $http->listen($socket);

        echo "Server listen host: http://$this->serverHost";
    }

    /**
     * return either an array of data from the DB
     * or throw exception with an appropriate message
     *
     * @return array
     * @throws Exception
     */
    private function kernel(Request $request): array
    {
        $result = [];

        foreach (require 'app/routes.php' as $route) {
            if (isset($route[$this->route][$this->method])) {

                foreach (require 'app/middlewares.php' as $middleware) {
                    foreach ($middleware['routes'] as $middlewareRoute) {
                        if (($middlewareRoute === $this->route) && !$middleware['func_result']) {
                            throw new Exception("\nError! Forbidden handling of the route $this->route by middleware\n");
                        }
                    }
                }

                $result = $route[$this->route][$this->method]['func_result']($request);

                if (is_array($result)) {
                    return $result;
                }

                throw new Exception(
                    "\nYour {$this->route} route handler function for {$this->method} 
                                     method, should return data array\n"
                );
            }

        }

        if (count($result) === 0) {
            throw new Exception(
                "\nThe route {$this->route} doesn't define\n"
            );
        }

        return $result;
    }


}
