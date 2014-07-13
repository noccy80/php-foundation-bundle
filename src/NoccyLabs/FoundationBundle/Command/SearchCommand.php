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
use NoccyLabs\FoundationBundle\Librarian;

/**
 * Description of ComponentsCommand
 *
 * @author noccy
 */
class SearchCommand extends Command implements ContainerAwareInterface
{
    protected $container;

    public function setContainer(ContainerInterface $container=null)
    {
        $this->container = $container;
    }

    protected function configure()
    {
        $this
            ->setName($this->getName()?:"foundation:search")
            ->setDescription("Find components")
            ->addArgument("match", InputArgument::OPTIONAL, "Find components matching string");
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $match = $input->getArgument("match");

        $lib = new Librarian();
        $libs_cdn = $lib->getLibraries(); 
        
        foreach($libs_cdn as $library=>$sources) {
            if (fnmatch("*{$match}*",$library)) {
                $output->write(" - <comment>{$library}</comment> ");
                $output->writeln("(<info>".join("</info>, <info>", array_column($sources,0))."</info>)");
            }
        }
        
    }
}
