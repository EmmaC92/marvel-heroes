<?php

namespace Emmanuelc\MarvelApi\Framework;

use Emmanuelc\MarvelApi\Framework\Router;

class App
{
    private Router $router;
    private Container $container;

    public function __construct(string $containerDefinitionPath = null)
    {
        $this->router = new Router();
        $this->container = new Container();

        if ($containerDefinitionPath) {
            $containerDefinition = include $containerDefinitionPath;
            $this->container->addDefinition($containerDefinition);
        }
    }
    public function get($path, $controller)
    {
        $this->router->add('GET', $path, $controller);
    }

    public function run()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $method = $_SERVER['REQUEST_METHOD'];

        $this->router->dispatch($method, $path, $this->container);
    }
}
