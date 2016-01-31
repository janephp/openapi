<?php

namespace Joli\Jane\OpenApi;

use Joli\Jane\Encoder\RawEncoder;
use Joli\Jane\Generator\Context\Context;
use Joli\Jane\Generator\File;
use Joli\Jane\Generator\ModelGenerator;
use Joli\Jane\Generator\Naming;
use Joli\Jane\Generator\NormalizerGenerator;
use Joli\Jane\Guesser\ChainGuesser;
use Joli\Jane\OpenApi\Generator\ClientGenerator;
use Joli\Jane\OpenApi\Generator\GeneratorFactory;
use Joli\Jane\OpenApi\Guesser\OpenApiSchema\GuesserFactory;
use Joli\Jane\OpenApi\Model\OpenApi;
use Joli\Jane\OpenApi\Normalizer\NormalizerFactory;
use PhpParser\PrettyPrinterAbstract;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use PhpCsFixer\Config;
use PhpCsFixer\ConfigInterface;
use PhpCsFixer\Console\ConfigurationResolver;
use PhpCsFixer\Finder;
use PhpCsFixer\Fixer;

class JaneOpenApi
{
    const VERSION = '1.0.x';

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
     * @var ConfigInterface
     */
    private $fixerConfig;

    public function __construct(
        SerializerInterface $serializer,
        ChainGuesser $chainGuesser,
        ModelGenerator $modelGenerator,
        NormalizerGenerator $normalizerGenerator,
        ClientGenerator $clientGenerator,
        PrettyPrinterAbstract $prettyPrinter,
        ConfigInterface $fixerConfig = null
    )
    {
        $this->serializer          = $serializer;
        $this->clientGenerator     = $clientGenerator;
        $this->prettyPrinter       = $prettyPrinter;
        $this->modelGenerator      = $modelGenerator;
        $this->normalizerGenerator = $normalizerGenerator;
        $this->chainGuesser        = $chainGuesser;
        $this->fixer               = $fixerConfig;
    }

    /**
     * Return a list of class guessed
     *
     * @param string $openApiSpec
     * @param string $name
     * @param string $namespace
     * @param string $directory
     *
     * @return Context
     */
    public function createContext($openApiSpec, $name, $namespace, $directory)
    {
        $schema  = $this->serializer->deserialize(file_get_contents($openApiSpec), 'Joli\Jane\OpenApi\Model\OpenApi', 'json');
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
     * @param string $openApiSpec Location of the specification
     * @param string $namespace   Namespace of the library
     * @param string $directory   Path for the root directory of the generated files
     *
     * @return File[]
     */
    public function generate($openApiSpec, $namespace, $directory)
    {
        /** @var OpenApi $openApi */
        $context = $this->createContext($openApiSpec, 'Client', $namespace, $directory);
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

        $this->fix($directory);
    }

    /**
     * Use php cs fixer to have a nice formatting of generated files
     *
     * @param string $directory
     *
     * @return array|void
     */
    protected function fix($directory)
    {
        if (!class_exists('PhpCsFixer\Config')) {
            return;
        }

        /** @var Config $fixerConfig */
        $fixerConfig = $this->fixerConfig;

        if (null === $fixerConfig) {
            $fixerConfig = Config::create()
                ->setRiskyAllowed(true)
                ->setRules(array(
                    '@Symfony' => true,
                    'simplified_null_return' => false,
                    'concat_without_spaces' => false,
                    'double_arrow_multiline_whitespaces' => false,
                    'unalign_equals' => false,
                    'unalign_double_arrow' => false,
                    'align_double_arrow' => true,
                    'align_equals' => true,
                    'concat_with_spaces' => true,
                    'ordered_imports' => true,
                    'phpdoc_order' => true,
                    'short_array_syntax' => true,
                ))
            ;

            $resolver = new ConfigurationResolver();
            $resolver->setDefaultConfig($fixerConfig);
            $resolver->resolve();
        }

        $finder = new Finder();
        $finder->in($directory);
        $fixerConfig->finder($finder);

        $fixer = new Fixer();

        return $fixer->fix($fixerConfig);
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

        return new self($serializer, GuesserFactory::create($serializer), $modelGenerator, $normGenerator, $clientGenerator, $prettyPrinter);
    }
}
