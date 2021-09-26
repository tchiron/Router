<?php

namespace Tchiron\Router;

use Tchiron\Router\Route\{Route, RouteInterface};
use Tchiron\Router\Exception\RouteNotFoundException;

class Router implements RouterInterface
{
    private static Router $instance;

    private array $routes = [];

    private array $matches = [];

    public function match(): void
    {
        foreach ($this->routes as $route) {
			$regex = $route->getRegex();
            if (preg_match("#^$regex$#", filter_input(INPUT_SERVER, 'REQUEST_URI'), $this->matches)) {
                foreach ($route->getMethods() as $method) {
                    if ($method === filter_input(INPUT_SERVER, 'REQUEST_METHOD')) {
						(new ($route->getController())())->{$route->getAction()}(...$this->matches);
						return;
                    }
                }
            }
        }

        throw new RouteNotFoundException(
            sprintf(
                'No route found for uri "%s" and method "%s"',
                filter_input(INPUT_SERVER, 'REQUEST_URI'),
                filter_input(INPUT_SERVER, 'REQUEST_METHOD')
            )
        );
    }

    public function add(string $path, array $methods, string $action, string $name): RouteInterface
    {
        $this->routes[] = $route = new Route($path, $methods, $action, $name);
        return $route;
    }

    public function findRoute(string $name): RouteInterface
    {
        foreach ($this->routes as $route) {
            if ($route->getName() === $name) {
                return $route;
            }
        }

        throw new RouteNotFoundException(sprintf('No route found for name "%s"', $name));
    }

    public static function getInstance(): RouterInterface
    {
        return self::$instance ?? self::$instance = new Router();
    }

    /**
     * @return array
     */
    public function getMatches(): array
    {
        return $this->matches;
    }
}
