<?php

namespace Joli\Jane\Swagger;

use Joli\Jane\Encoder\RawEncoder;
use Joli\Jane\Generator\Context\Context;
use Joli\Jane\Generator\File;
use Joli\Jane\Generator\ModelGenerator;
use Joli\Jane\Generator\Naming;
use Joli\Jane\Generator\NormalizerGenerator;
use Joli\Jane\Guesser\ChainGuesser;
use Joli\Jane\Swagger\Generator\ClientGenerator;
use Joli\Jane\Swagger\Generator\GeneratorFactory;
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
use Symfony\CS\Console\ConfigurationResolver;
use Symfony\CS\Finder\DefaultFinder;
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
     * @var ChainGuesser
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
     * @param string $swaggerSpec
     * @param string $name
     * @param string $namespace
     * @param string $directory
     *
     * @return Context
     */
    public function createContext($swaggerSpec, $name, $namespace, $directory)
    {
        $schema  = $this->serializer->deserialize(file_get_contents($swaggerSpec), 'Joli\Jane\Swagger\Model\Swagger', 'json');
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

    /**
     * Generate a list of files
     *
     * @param string $swaggerSpec Location of the specification
     * @param string $namespace   Namespace of the library
     * @param string $directory   Path for the root directory of the generated files
     *
     * @return File[]
     */
    public function generate($swaggerSpec, $namespace, $directory)
    {
        /** @var Swagger $swagger */
        $context = $this->createContext($swaggerSpec, 'Client', $namespace, $directory);
        $files   = [];
        $files   = array_merge($files, $this->modelGenerator->generate($context->getRootReference(), 'Client', $context));
        $files   = array_merge($files, $this->normalizerGenerator->generate($context->getRootReference(), 'Client', $context));
        $clients = $this->clientGenerator->generate($context->getRootReference(), $namespace, $context);

        foreach ($clients as $node) {
            $files[] = new File($directory . DIRECTORY_SEPARATOR . 'Resource' . DIRECTORY_SEPARATOR . $node->stmts[2]->name . '.php', $node, '');
        }

        return $files;
    }

    /**
     * Print files
     *
     * @param File[] $files
     * @param string $directory
     */
    public function printFiles($files, $directory)
    {
        foreach ($files as $file) {
            if (!file_exists(dirname($file->getFilename()))) {
                mkdir(dirname($file->getFilename()), 0755, true);
            }

            file_put_contents($file->getFilename(), $this->prettyPrinter->prettyPrintFile([$file->getNode()]));
        }

        if ($this->fixer !== null) {
            $config = Config::create()
                ->setRiskyAllowed(true)
                ->setRules(array(
                    '@Symfony' => true,
                    'empty_return' => false,
                    'concat_without_spaces' => false,
                    'double_arrow_multiline_whitespaces' => false,
                    'unalign_equals' => false,
                    'unalign_double_arrow' => false,
                    'align_double_arrow' => true,
                    'align_equals' => true,
                    'concat_with_spaces' => true,
                    'newline_after_open_tag' => true,
                    'ordered_use' => true,
                    'phpdoc_order' => true,
                    'short_array_syntax' => true,
                ))
                ->finder(
                    DefaultFinder::create()
                        ->in($directory)
                )
            ;

            $resolver = new ConfigurationResolver();
            $resolver->setDefaultConfig($config);
            $resolver->resolve();

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

        return new self($serializer, GuesserFactory::create($serializer), $modelGenerator, $normGenerator, $clientGenerator, $prettyPrinter, $fixer);
    }
}
