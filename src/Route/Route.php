<?php

namespace Tchiron\Router\Route;

class Route implements RouteInterface
{
    public const ACTION_SEPARATOR = '::';

    public const SLUG_DELIMITER = [
        'starting_point' => '[',
        'ending_point' => ']'
    ];

    public const SLUG_SEPARATOR = '_';

    private string $path;

    private string $regex;

    private array $methods;

    private string $controller;

    private string $action;

    private string $name;

    public function __construct(
        string $path,
        array $methods,
        string $action,
        string $name
    ) {
        $this->path = $path;
        $this->regex = preg_replace('#\[([\w]+)]#', '([\w]+)', $path) ?? throw new \Exception();
        $this->methods = $methods;
        $this->name = $name;
        $actionInfo = explode('::', $action);
        $this->controller = $actionInfo[0];
        $this->action = $actionInfo[1];
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getRegex(): string
    {
        return $this->regex;
    }

    /**
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
