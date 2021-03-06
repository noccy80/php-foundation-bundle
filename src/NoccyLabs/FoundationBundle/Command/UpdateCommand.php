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
use NoccyLabs\FoundationBundle\Cdn\Manager;

/**
 * Description of ComponentsCommand
 *
 * @author noccy
 */
class UpdateCommand extends Command implements ContainerAwareInterface
{
    protected $container;

    public function setContainer(ContainerInterface $container=null)
    {
        $this->container = $container;
    }

    protected function configure()
    {
        $this
            ->setName($this->getName()?:"foundation:update")
            ->setDescription("Update the list of components")
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $resources_dir = __DIR__ . "/../Resources";
        $components_dir = $resources_dir . "/component";
        $cdns_dir = $resources_dir . "/cdn";

        $manager = new Manager();
        $manager->setPath($cdns_dir);
        $manager->setOutput($output);
        $manager->updateAll();
        
    }
}
