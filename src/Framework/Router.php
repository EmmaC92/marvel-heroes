<?php

declare(strict_types=1);

namespace Emmanuelc\MarvelApi\Framework;

use Emmanuelc\MarvelApi\Framework\Container;

class Router
{
    private array $routes = [];

    public function add(string $method, string $path, array $controler): void
    {
        $path = $this->serializePath($path);
        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            'controller' => $controler
        ];
    }

    private function serializePath(string $path): string
    {
        $path = trim($path, '/');
        $path = "/$path/";

        return preg_replace("#[/]{2,}#", "/", $path);
    }

    public function dispatch(string $method, string $path, Container $container): void
    {
        $path = $this->serializePath($path);
        $method = strtoupper($method);

        foreach ($this->routes as $route) {
            
            if ($route['path']!== $path || $route['method'] !== $method ) {
                continue;
            }
            
            [$class, $function] = $route['controller'];

            $controller = $container ? $container->resolve($class) : new $class();
            $controller->{$function}();

            break;
        }
    }
}
