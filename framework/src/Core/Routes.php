<?php

namespace Framework\Core;

class Routes
{
    public static function findFor(mixed $requestPath): ?array
    {
        return self::getAll()['/' . ltrim($requestPath, '/')] ?? null;
    }

    public static function getAll(): array
    {
        if (class_exists(\Framework\Cached\RouteList::class)) {
            return \Framework\Cached\RouteList::$routes;
        }
        return self::$routes;
    }

    /**
     * Used during the setup phase.
     */
    public static array $routes = [];

    /**
     * Used during the setup phase.
     */
    public static function registerRoute(string $path, string $class, string $method): void
    {
        self::$routes['/' . ltrim($path, '/')] = [
            'class' => $class,
            'method' => $method,
        ];
    }
}
