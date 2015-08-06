<?php

namespace Joli\Jane\Swagger;

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

    public function __construct(SerializerInterface $serializer, ClientGenerator $clientGenerator, PrettyPrinterAbstract $prettyPrinter)
    {
        $this->serializer = $serializer;
        $this->clientGenerator = $clientGenerator;
        $this->prettyPrinter = $prettyPrinter;
    }

    public function generate($swaggerSpec, $namespace, $directory)
    {
        $swagger = $this->serializer->deserialize(file_get_contents($swaggerSpec), Swagger::class, 'json');
        $clients = $this->clientGenerator->generate($swagger, $namespace);

        foreach ($clients as $node) {
            $filename = $directory . DIRECTORY_SEPARATOR . $node->stmts[3]->name . '.php';

            file_put_contents($filename, $this->prettyPrinter->prettyPrintFile([$node]));
        }
    }

    public static function build()
    {
        $encoders    = [new JsonEncoder(new JsonEncode(), new JsonDecode(false))];
        $normalizers = [NormalizerChain::build()];
        $serializer  = new Serializer($normalizers, $encoders);
        $clientGenerator = GeneratorFactory::build();
        $prettyPrinter   = new \PhpParser\PrettyPrinter\Standard();

        return new self($serializer, $clientGenerator, $prettyPrinter);
    }
} 
