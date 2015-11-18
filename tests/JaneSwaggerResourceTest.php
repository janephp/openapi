<?php

namespace Joli\Jane\Swagger\Tests;

use Joli\Jane\Swagger\JaneSwagger;
use PhpParser\PrettyPrinter\Standard;
use Symfony\Component\Finder\Finder;

class JaneSwaggerResourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider resourceProvider
     */
    public function testRessources($expected, $swaggerSpec, $name)
    {
        $swagger = JaneSwagger::build();
        $printer = new Standard();
        $files   = $swagger->generate($swaggerSpec, 'Joli\Jane\Swagger\Tests\Expected', 'dummy');

        // Resource + NormalizerFactory
        $this->assertCount(2, $files);

        $resource = $files[1];

        $this->assertEquals($resource->getFilename(), 'dummy/Resource/TestResource.php');
        $this->assertEquals(trim($expected), trim($printer->prettyPrintFile([$resource->getNode()])));
    }

    public function resourceProvider()
    {
        $finder = new Finder();
        $finder->directories()->in(__DIR__.'/fixtures');
        $finder->depth('< 1');

        $data = array();

        foreach ($finder as $directory) {
            $data[] = [
                file_get_contents($directory->getRealPath().'/Resource/TestResource.php'),
                $directory->getRealPath().'/swagger.json',
                $directory->getFilename()
            ];
        }

        return $data;
    }
}
