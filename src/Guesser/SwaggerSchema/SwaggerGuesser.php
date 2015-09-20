<?php

namespace Joli\Jane\Swagger\Guesser\SwaggerSchema;

use Joli\Jane\Guesser\ChainGuesserAwareInterface;
use Joli\Jane\Guesser\ChainGuesserAwareTrait;
use Joli\Jane\Guesser\ClassGuesserInterface;
use Joli\Jane\Guesser\GuesserInterface;

use Joli\Jane\Swagger\Model\BodyParameter;
use Joli\Jane\Swagger\Model\Operation;
use Joli\Jane\Swagger\Model\PathItem;
use Joli\Jane\Swagger\Model\Response;
use Joli\Jane\Swagger\Model\Swagger;

class SwaggerGuesser implements GuesserInterface, ClassGuesserInterface, ChainGuesserAwareInterface
{
    use ChainGuesserAwareTrait;

    /**
     * {@inheritDoc}
     */
    public function supportObject($object)
    {
        return ($object instanceof Swagger);
    }

    /**
     * {@inheritDoc}
     *
     * @param Swagger $object
     */
    public function guessClass($object, $name)
    {
        $classes = [];

        foreach ($object->getDefinitions() as $key => $definition) {
            $classes = array_merge($classes, $this->chainGuesser->guessClass($definition, $key));
        }

        foreach ($object->getPaths() as $pathName => $path) {
            if ($path instanceof PathItem) {
                $classes = array_merge($classes, $this->getClassFromOperation($pathName, $path->getDelete()));
                $classes = array_merge($classes, $this->getClassFromOperation($pathName, $path->getGet()));
                $classes = array_merge($classes, $this->getClassFromOperation($pathName, $path->getHead()));
                $classes = array_merge($classes, $this->getClassFromOperation($pathName, $path->getOptions()));
                $classes = array_merge($classes, $this->getClassFromOperation($pathName, $path->getPatch()));
                $classes = array_merge($classes, $this->getClassFromOperation($pathName, $path->getPost()));
                $classes = array_merge($classes, $this->getClassFromOperation($pathName, $path->getPut()));

                $classes = array_merge($classes, $this->getClassFromParameters($pathName, $path->getParameters()));
            }
        }

        $classes = array_merge($classes, $this->getClassFromParameters($name, $object->getParameters()));

        return $classes;
    }

    /**
     * Discover classes in operation
     *
     * @param $name
     * @param Operation $operation
     *
     * @return array
     */
    protected function getClassFromOperation($name, Operation $operation = null)
    {
        if ($operation === null) {
            return [];
        }

        $classes = [];
        $classes = array_merge($classes, $this->getClassFromParameters($name, $operation->getParameters()));

        foreach ($operation->getResponses() as $response) {
            if ($response instanceof Response) {
                $classes = array_merge($classes, $this->chainGuesser->guessClass($response->getSchema(), $name.'Response'));
            }
        }

        return $classes;
    }

    /**
     * Discover class in parameters
     *
     * @param $name
     * @param $parameters
     *
     * @return array
     */
    protected function getClassFromParameters($name, $parameters)
    {
        if ($parameters === null) {
            return [];
        }

        $classes = [];

        foreach ($parameters as $parameterName => $parameter) {
            if ($parameter instanceof BodyParameter) {
                $classes = array_merge($classes, $this->chainGuesser->guessClass($parameter->getSchema(), $parameterName));
            }
        }

        return $classes;
    }
}
 