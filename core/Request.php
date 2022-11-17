<?php

declare(strict_types=1);

namespace Core;

final class Request
{
    private string $method;
    private string $route;
    private array  $body;
    private array  $params;

    /**
     * @return string
     */
    public function getMethod(): string {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getRoute(): string {
        return $this->route;
    }

    /**
     * @return array
     */
    public function getBody(): array {
        return $this->body;
    }

    /**
     * @return array
     */
    public function getParams(): array {
        return $this->params;
    }

    /**
     * @param string $method
     * @return void
     */
    public function setMethod(string $method = ''): void {
        $this->method = $method;
    }

    /**
     * @param string $route
     * @return void
     */
    public function setRoute(string $route = ''): void {
        $this->route = $route;
    }

    /**
     * @param array $body
     * @return void
     */
    public function setBody(array $body = []): void {
        $this->body = $body;
    }

    /**
     * @param array $params
     * @return void
     */
    public function setParams(array $params = []): void {
        $this->params = $params;
    }
}