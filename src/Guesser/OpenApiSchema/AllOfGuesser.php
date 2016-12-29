<?php

namespace Joli\Jane\OpenApi\Guesser\OpenApiSchema;

use Joli\Jane\Guesser\JsonSchema\AllOfGuesser as BaseAllOfGuesser;
use Joli\Jane\Guesser\PropertiesGuesserInterface;
use Joli\Jane\OpenApi\Model\Schema;
use Joli\Jane\Reference\Resolver;
use Joli\Jane\Runtime\Reference;

class AllOfGuesser extends BaseAllOfGuesser implements PropertiesGuesserInterface
{
    /**
     * @var Resolver
     */
    private $resolver;

    /**
     * AllOfGuesser constructor.
     *
     * @param Resolver $resolver
     */
    public function __construct(Resolver $resolver)
    {
        $this->resolver = $resolver;

        parent::__construct($resolver);
    }


    /**
     * {@inheritDoc}
     */
    public function supportObject($object)
    {
        return (($object instanceof Schema) && is_array($object->getAllOf()) && count($object->getAllOf()) > 0);
    }

    /**
     * Return all properties guessed
     *
     * @param Schema                                $object
     * @param string                                $name
     * @param \Joli\Jane\Guesser\Guess\ClassGuess[] $classes
     *
     * @return \Joli\Jane\Guesser\Guess\Property[]
     */
    public function guessProperties($object, $name, $classes)
    {
        $properties = [];

        foreach ($object->getAllOf() as $allOfSchema) {
            if ($allOfSchema instanceof Reference) {
                $allOfSchema = $this->resolver->resolve($allOfSchema);
            }

            $properties = array_merge($properties, $this->chainGuesser->guessProperties($allOfSchema, $name, $classes));
        }

        return $properties;
    }
}
