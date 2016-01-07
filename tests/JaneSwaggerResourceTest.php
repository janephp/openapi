<?php

namespace Joli\Jane\Swagger\Tests;

use Joli\Jane\Swagger\JaneSwagger;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class JaneSwaggerResourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider resourceProvider
     */
    public function testRessources(SplFileInfo $testDirectory)
    {
        // 1. Cleanup generated
        $filesystem = new Filesystem();

        if ($filesystem->exists($testDirectory->getRealPath() . DIRECTORY_SEPARATOR . 'generated')) {
            $filesystem->remove($testDirectory->getRealPath() . DIRECTORY_SEPARATOR . 'generated');
        }

        $filesystem->mkdir($testDirectory->getRealPath() . DIRECTORY_SEPARATOR . 'generated');

        // 2. Generate
        $swagger = JaneSwagger::build();
        $files   = $swagger->generate(
            $testDirectory->getRealPath() . DIRECTORY_SEPARATOR . 'swagger.json',
            'Joli\Jane\Swagger\Tests\Expected',
            $testDirectory->getRealPath() . DIRECTORY_SEPARATOR . 'generated'
        );

        $swagger->printFiles($files, $testDirectory->getRealPath() . DIRECTORY_SEPARATOR . 'generated');

        // 3. Compare
        $expectedFinder = new Finder();
        $expectedFinder->in($testDirectory->getRealPath() . DIRECTORY_SEPARATOR . 'expected');

        $generatedFinder = new Finder();
        $generatedFinder->in($testDirectory->getRealPath() . DIRECTORY_SEPARATOR . 'generated');

        $generatedData = [];

        $this->assertEquals(count($expectedFinder), count($generatedFinder));

        foreach ($generatedFinder as $generatedFile) {
            $generatedData[$generatedFile->getRelativePathname()] = $generatedFile->getRealPath();
        }

        foreach ($expectedFinder as $expectedFile) {
            $this->assertArrayHasKey($expectedFile->getRelativePathname(), $generatedData);

            if ($expectedFile->isFile()) {
                $this->assertEquals(file_get_contents($expectedFile->getRealPath()), file_get_contents($generatedData[$expectedFile->getRelativePathname()]));
            }
        }
    }

    public function resourceProvider()
    {
        $finder = new Finder();
        $finder->directories()->in(__DIR__.'/fixtures');
        $finder->depth('< 1');

        $data = array();

        foreach ($finder as $directory) {
            $data[] = [$directory];
        }

        return $data;
    }
}
