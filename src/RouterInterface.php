<?php

namespace Tchiron\Router;

use Tchiron\Router\Route\RouteInterface;

interface RouterInterface
{
    public function match(): void;

    public function add(string $path, array $methods, string $action, string $name): RouteInterface;

    public function findRoute(string $name): RouteInterface;

    public static function getInstance(): RouterInterface;

    public function getMatches(): array;
}
