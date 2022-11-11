<?php

namespace App\Core;

use Exception;
use React\Http\HttpServer;
use React\Socket\SocketServer;
use React\Http\Message\Response;
use Psr\Http\Message\ServerRequestInterface;

class Server
{
    private string $serverHost;
    private string $dbHost;
    private string $dbName;
    private string $dbUsername;
    private string $dbPassword;

    private string $route;
    private string $method;
    private string $body;
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
        $http = new HttpServer(function (ServerRequestInterface $request) {
            $this->method = $request->getMethod();
            $this->route = $request->getUri()->getPath();
            $this->params = $request->getQueryParams();
            $this->body = $request->getBody()->getContents();

            $response = [];

            try {
                $response = $this->checkRoutes();
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
     * or throw exception with appropriate message
     *
     * @return array
     * @throws Exception
     */
    private function checkRoutes(): array
    {
        $result = [];

        foreach (require 'app/routes.php' as $route) {

            if (isset($route[$this->route][$this->method])) {

                $result = $route[$this->route][$this->method]['func_result'];

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

    private function checkMiddlewares(string $currentRoute): bool
    {
        $middlewares = require 'app/routes.php';

        return false;
    }

}
