<?php

declare(strict_types=1);

namespace Core;

final class Request
{
    public function __construct(
        private readonly string $method,
        private readonly string $route,
        private readonly array  $body,
        private readonly array  $params,
    )
    {
        //
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}