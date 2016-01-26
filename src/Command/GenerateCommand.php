<?php

namespace Joli\Jane\Command;

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
        $this->addArgument('json-schema-file', InputArgument::REQUIRED, 'Location of the Json Schema file');
        $this->addArgument('root-class', InputArgument::REQUIRED, 'Name of the root entity you want to generate');
        $this->addArgument('namespace', InputArgument::REQUIRED, 'Namespace prefix to use for generated files');
        $this->addArgument('directory', InputArgument::REQUIRED, 'Directory where to generate files');
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $jsonSchemaFilepath = $input->getArgument('json-schema-file');
        $rootClassname      = $input->getArgument('root-class');
        $namespace          = $input->getArgument('namespace');
        $generateDirectory  = $input->getArgument('directory');

        $jane = \Joli\Jane\Jane::build();
        $files = $jane->generate($jsonSchemaFilepath, $rootClassname, $namespace, $generateDirectory);

        foreach ($files as $file) {
            $output->writeln(sprintf("Generated %s", $file));
        }
    }
}
