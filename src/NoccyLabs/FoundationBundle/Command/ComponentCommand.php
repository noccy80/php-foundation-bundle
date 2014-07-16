<?php

namespace NoccyLabs\FoundationBundle\Command;

use NoccyLabs\FoundationBundle\Librarian;
use Symfony\Component\Console\Command\Command;
//use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Description of ComponentsCommand
 *
 * @author noccy
 */
class ComponentCommand extends Command implements ContainerAwareInterface
{
    protected $container;

    public function setContainer(ContainerInterface $container=null)
    {
        $this->container = $container;
    }

    protected function configure()
    {
        $this
            ->setName($this->getName()?:"foundation:component")
            ->setDescription("Show information on a specific component")
            ->addArgument("component", InputArgument::OPTIONAL, "Component name");
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $match = $input->getArgument("component");

        $lib = new Librarian();
        $url = $lib->getLibraryUrl($match); 
        
        $output->writeln("URL: {$url}");
        
    }
}
