<?php

namespace Joli\Jane\Swagger;

use Joli\Jane\Encoder\RawEncoder;
use Joli\Jane\Generator\Context\Context;
use Joli\Jane\Generator\File;
use Joli\Jane\Generator\ModelGenerator;
use Joli\Jane\Generator\Naming;
use Joli\Jane\Generator\NormalizerGenerator;
use Joli\Jane\Swagger\Generator\ClientGenerator;
use Joli\Jane\Swagger\Generator\GeneratorFactory;
use Joli\Jane\Swagger\Guesser\ChainGuesser;
use Joli\Jane\Swagger\Guesser\SwaggerSchema\GuesserFactory;
use Joli\Jane\Swagger\Model\Swagger;
use Joli\Jane\Swagger\Normalizer\NormalizerFactory;

use PhpParser\PrettyPrinterAbstract;

use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\CS\Config\Config;
use Symfony\CS\ConfigurationResolver;
use Symfony\CS\FixerInterface;
use Symfony\CS\Fixer;

class JaneSwagger
{
    /**
     * @var \Symfony\Component\Serializer\SerializerInterface
     */
    private $serializer;

    /**
     * @var Generator\ClientGenerator
     */
    private $clientGenerator;

    /**
     * @var \PhpParser\PrettyPrinterAbstract
     */
    private $prettyPrinter;

    /**
     * @var ModelGenerator
     */
    private $modelGenerator;

    /**
     * @var NormalizerGenerator
     */
    private $normalizerGenerator;

    /**
     * @var Guesser\ChainGuesser
     */
    private $chainGuesser;

    /**
     * @var Fixer
     */
    private $fixer;

    public function __construct(SerializerInterface $serializer, ChainGuesser $chainGuesser, ModelGenerator $modelGenerator, NormalizerGenerator $normalizerGenerator, ClientGenerator $clientGenerator, PrettyPrinterAbstract $prettyPrinter, Fixer $fixer)
    {
        $this->serializer          = $serializer;
        $this->clientGenerator     = $clientGenerator;
        $this->prettyPrinter       = $prettyPrinter;
        $this->modelGenerator      = $modelGenerator;
        $this->normalizerGenerator = $normalizerGenerator;
        $this->chainGuesser        = $chainGuesser;
        $this->fixer               = $fixer;
    }

    /**
     * Return a list of class guessed
     *
     * @param $swaggerSpec
     * @param $name
     * @param $namespace
     * @param $directory
     *
     * @return Context
     */
    public function createContext($swaggerSpec, $name, $namespace, $directory)
    {
        $schema  = $this->serializer->deserialize(file_get_contents($swaggerSpec), Swagger::class, 'json');
        $classes = $this->chainGuesser->guessClass($schema, $name);

        foreach ($classes as $class) {
            $properties = $this->chainGuesser->guessProperties($class->getObject(), $name, $classes);

            foreach ($properties as $property) {
                $property->setType($this->chainGuesser->guessType($property->getObject(), $property->getName(), $classes));
            }

            $class->setProperties($properties);
        }

        return new Context($schema, $namespace, $directory, $classes);
    }

    public function generate($swaggerSpec, $namespace, $directory)
    {
        /** @var Swagger $swagger */
        $context = $this->createContext($swaggerSpec, 'Client', $namespace, $directory);
        $files   = [];
        $files   = array_merge($files, $this->modelGenerator->generate($context->getRootReference(), 'Client', $context));
        $files   = array_merge($files, $this->normalizerGenerator->generate($context->getRootReference(), 'Client', $context));
        $clients = $this->clientGenerator->generate($context->getRootReference(), $namespace, $context);

        foreach ($clients as $node) {
            $files[] = new File($directory . DIRECTORY_SEPARATOR . 'Resource' . DIRECTORY_SEPARATOR . $node->stmts[3]->name . '.php', $node, '');
        }

        foreach ($files as $file) {
            if (!file_exists(dirname($file->getFilename()))) {
                mkdir(dirname($file->getFilename()), 0755, true);
            }

            file_put_contents($file->getFilename(), $this->prettyPrinter->prettyPrintFile([$file->getNode()]));
        }

        if ($this->fixer !== null) {
            $config = new Config();
            $config->setDir($directory);
            $config->level(FixerInterface::PSR0_LEVEL | FixerInterface::PSR1_LEVEL | FixerInterface::PSR2_LEVEL);

            $resolver = new ConfigurationResolver();
            $resolver
                ->setAllFixers($this->fixer->getFixers())
                ->setConfig($config)
                ->resolve();

            $config->fixers(array_merge($resolver->getFixers(), [
                new Fixer\Symfony\ReturnFixer()
            ]));

            $this->fixer->fix($config);
        }
    }

    public static function build()
    {
        $encoders        = [new JsonEncoder(new JsonEncode(), new JsonDecode(false)), new RawEncoder()];
        $normalizers     = NormalizerFactory::create();
        $serializer      = new Serializer($normalizers, $encoders);
        $clientGenerator = GeneratorFactory::build();
        $prettyPrinter   = new \PhpParser\PrettyPrinter\Standard();
        $naming          = new Naming();
        $modelGenerator  = new ModelGenerator($naming);
        $normGenerator   = new NormalizerGenerator($naming);
        $fixer           = new Fixer();
        $fixer->registerBuiltInFixers();

        return new self($serializer, GuesserFactory::create($serializer), $modelGenerator, $normGenerator, $clientGenerator, $prettyPrinter, $fixer);
    }
} 
