<?php

namespace Joli\Jane\Swagger;

use Joli\Jane\Generator\Context\Context;
use Joli\Jane\Generator\File;
use Joli\Jane\Generator\ModelGenerator;
use Joli\Jane\Generator\NormalizerGenerator;
use Joli\Jane\Generator\TypeDecisionManager;
use Joli\Jane\Swagger\Generator\ClientGenerator;
use Joli\Jane\Swagger\Generator\GeneratorFactory;
use Joli\Jane\Swagger\Model\Swagger;
use Joli\Jane\Swagger\Normalizer\NormalizerChain;

use PhpParser\PrettyPrinterAbstract;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

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

    public function __construct(SerializerInterface $serializer, ModelGenerator $modelGenerator, NormalizerGenerator $normalizerGenerator, ClientGenerator $clientGenerator, PrettyPrinterAbstract $prettyPrinter)
    {
        $this->serializer = $serializer;
        $this->clientGenerator = $clientGenerator;
        $this->prettyPrinter = $prettyPrinter;
        $this->modelGenerator = $modelGenerator;
        $this->normalizerGenerator = $normalizerGenerator;
    }

    public function generate($swaggerSpec, $namespace, $directory)
    {
        /** @var Swagger $swagger */
        $swagger = $this->serializer->deserialize(file_get_contents($swaggerSpec), Swagger::class, 'json');
        $context = new Context($swagger, $namespace, $directory);
        $files   = [];

        foreach ($swagger->getDefinitions() as $key => $definition) {
            if ($definition->getType() == "object") {
                $files = array_merge($files, $this->modelGenerator->generate($definition, ucfirst($key), $context));
                $files = array_merge($files, $this->normalizerGenerator->generate($definition, ucfirst($key), $context));
            }
        }

        $clients = $this->clientGenerator->generate($swagger, $namespace);

        foreach ($clients as $node) {
            $files[] = new File($directory . DIRECTORY_SEPARATOR . 'Resource' . DIRECTORY_SEPARATOR . $node->stmts[3]->name . '.php', $node);
        }

        foreach ($files as $file) {
            file_put_contents($file->getFilename(), $this->prettyPrinter->prettyPrintFile([$file->getNode()]));
        }
    }

    public static function build()
    {
        $encoders    = [new JsonEncoder(new JsonEncode(), new JsonDecode(false))];
        $normalizers = [NormalizerChain::build()];
        $serializer  = new Serializer($normalizers, $encoders);
        $clientGenerator = GeneratorFactory::build();
        $prettyPrinter   = new \PhpParser\PrettyPrinter\Standard();
        $typeDecision   = TypeDecisionManager::build($serializer);
        $modelGenerator = new ModelGenerator($typeDecision);
        $normGenerator  = new NormalizerGenerator($typeDecision);

        return new self($serializer, $modelGenerator, $normGenerator, $clientGenerator, $prettyPrinter);
    }
} 
