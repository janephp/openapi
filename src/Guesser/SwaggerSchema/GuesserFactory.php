<?php

namespace Joli\Jane\Swagger\Guesser\SwaggerSchema;

use Joli\Jane\Generator\Naming;
use Joli\Jane\Guesser\ReferenceGuesser;
use Joli\Jane\Reference\Resolver;
use Joli\Jane\Swagger\Guesser\ChainGuesser;

use Symfony\Component\Serializer\SerializerInterface;

class GuesserFactory
{
    public static function create(SerializerInterface $serializer)
    {
        $naming = new Naming();
        $resolver = new Resolver($serializer);

        $chainGuesser = new ChainGuesser();
        $chainGuesser->addGuesser(new ReferenceGuesser($resolver));
        $chainGuesser->addGuesser(new SwaggerGuesser());
        $chainGuesser->addGuesser(new SchemaGuesser($naming, $resolver));
        $chainGuesser->addGuesser(new AdditionalPropertiesGuesser());
        $chainGuesser->addGuesser(new AllOfGuesser($resolver));
        $chainGuesser->addGuesser(new ArrayGuesser());
        $chainGuesser->addGuesser(new ItemsGuesser());
        $chainGuesser->addGuesser(new SimpleTypeGuesser());
        $chainGuesser->addGuesser(new MultipleGuesser());

        return $chainGuesser;
    }
}
 