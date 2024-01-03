<?php

namespace Emmanuelc\MarvelApi\Framework;

use Emmanuelc\MarvelApi\Framework\Exception\ContainerException;
use ReflectionClass, ReflectionNamedType;

class Container
{
    private array $definitions = [];

    public function addDefinition(array $definitions): void
    {
        $this->definitions = array_merge($this->definitions, $definitions);
    }

    public function resolve(string $className)
    {
        $reflection = new ReflectionClass($className);

        if (!$reflection->isInstantiable()) {
            throw new ContainerException("no instatiable controller found");
        }

        $constructor = $reflection->getConstructor();

        if (!$constructor) {
            return new $className;
        }

        $parameters = $constructor->getParameters();

        if (count($parameters) === 0) {
            return new $className;
        }

        $dependencies = [];
        foreach ($parameters as $param) {
            $type = $param->getType();
            $name = $param->getName();

            if (!$type) {
                throw new ContainerException("problem with {$name}");
            }

            if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                throw new ContainerException("problem with {$name} type");
            }

            $dependencies[] = $this->getDependency($type->getName());
        }

        return $reflection->newInstanceArgs($dependencies);
    }

    private function getDependency($id)
    {
        if (!array_key_exists($id, $this->definitions)) {
            throw new ContainerException("Service for {$id} is not declared");
        }

        $factory = $this->definitions[$id];

        return $factory();
    }
}