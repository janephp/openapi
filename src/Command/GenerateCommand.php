<?php

namespace Joli\Jane\OpenApi\Command;

use Joli\Jane\OpenApi\JaneOpenApi;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->setName('generate');
        $this->setDescription('Generate an api client: class, normalizers and resources given a specific Json OpenApi file');
        $this->addArgument('openapi-file', InputArgument::REQUIRED, 'Location of the OpenApi (Swagger) Schema file');
        $this->addArgument('namespace', InputArgument::REQUIRED, 'Namespace prefix to use for generated files');
        $this->addArgument('directory', InputArgument::REQUIRED, 'Directory where to generate files');
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $openApiSchemaFile = $input->getArgument('openapi-file');
        $namespace         = $input->getArgument('namespace');
        $generateDirectory = $input->getArgument('directory');

        $janeOpenApi = JaneOpenApi::build();
        $files = $janeOpenApi->generate($openApiSchemaFile, $namespace, $generateDirectory);

        foreach ($files as $file) {
            $output->writeln(sprintf("Generate %s", $file->getFilename()));
            $janeOpenApi->printFiles([$file], $generateDirectory);
        }
    }
}
