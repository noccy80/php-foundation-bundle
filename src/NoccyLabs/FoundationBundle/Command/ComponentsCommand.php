<?php

namespace NoccyLabs\FoundationBundle\Command;

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
class ComponentsCommand extends Command implements ContainerAwareInterface
{
    protected $container;

    public function setContainer(ContainerInterface $container=null)
    {
        $this->container = $container;
    }

    protected function configure()
    {
        $this
            ->setName($this->getName()?:"foundation:components")
            ->setDescription("List available components")
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $resources_dir = __DIR__ . "/../Resources";
        $components_dir = $resources_dir . "/component";
        $cdns_dir = $resources_dir . "/cdn";

        $verbose = ($output->getVerbosity() > 0);
        
        foreach(new \DirectoryIterator($components_dir) as $item) {
            if ($item->isFile() && fnmatch("*.yml",$item->getBasename())) {
                $component = new \NoccyLabs\FoundationBundle\Component($item->getPathname());
                $component_name = $component->getName();
                $component_ver = $component->getVersion();
                $output->write("<info>{$component_name}</info> version <comment>{$component_ver}</comment>\n");
            }
        }
        
    }
}
