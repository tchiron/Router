<?php

namespace Tchiron\Router\Route;

interface RouteInterface
{
    /**
     * @return string
     */
    public function getPath(): string;

    /**
     * @return string
     */
    public function getRegex(): string;

    /**
     * @return array
     */
    public function getMethods(): array;

    /**
     * @return string
     */
    public function getController(): string;

    /**
     * @return string
     */
    public function getAction(): string;

    /**
     * @return string
     */
    public function getName(): string;
}
