<?php

namespace Framework\Core;

/**
 * The main request that handles the full app.
 */
class Request
{
    public ?array $route;

    public function __construct()
    {
        $requestPath = $_SERVER['REQUEST_URI'];

        $this->route = Routes::findFor($requestPath);
    }

    public function getResponse(): void
    {
        if ($this->route) {
            $instance = new $this->route['class'];

            print($instance->{$this->route['method']}());
            return;
        }

        header("HTTP/1.0 404 Not Found");
        if (\Framework\Core\App::$debug) {
            debugMessage('Available routes:' . print_r(Routes::getAll(), true));
        }

        print('page not found');
    }
}
