<?php

namespace NoccyLabs\FoundationBundle\Cdn;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Output\OutputInterface;
use NoccyLabs\FoundationBundle\Cdn\CdnInterface;
use Symfony\Component\Yaml\Yaml;


class Manager implements LoggerAwareInterface
{

    protected static $default_cdns = array();
    
    protected $cdns = array();
    
    /**
     * @var Psr\Log\LoggerInterface The assigned interface for logging
     */
    protected $logger;
    
    /**
     * @var Symfony\Component\Console\Output\OutputInterface The assigned output interface
     */
    protected $output;

    /**
     *
     * @param Psr\Log\LoggerInterface New logger interface or NULL to unset
     */
    public function setLogger(LoggerInterface $logger=NULL)
    {
        $this->logger = $logger;
    }

    /**
     *
     * @param Symfony\Component\Console\Output\OutputInterface Output interface
     */
    public function setOutput(OutputInterface $output=NULL)
    {
        $this->output = $output;
    }
    
    /**
     * Set the path where the .yml files are stored for the CDNs. This is
     * normally in Resources/cdn of the bundle.
     *
     * @param string The path where the cdn .yml files are stored
     */
    public function setPath($path)
    {
        $this->path = $path;
    }
    
    /**
     * Update all CDNs
     *
     */
    public function updateAll()
    {
        $cdns = array_merge(
            self::$default_cdns,
            $this->cdns
        );
        
        foreach ($cdns as $id => $cdn) {
            $this->update($id, $cdn);
        }
    }

    /**
     * Update a single CDN
     *
     */
    public function update($id, CdnInterface $cdn) 
    {
        // Figure out the name of the .yml file to write
        $data_file = $this->path . "/" . $id . ".yml";
    
        $cdn->setOutput($this->output);
        $cdn->setLogger($this->logger);
    
        // Request an update of the data from the CDN
        $libs = $cdn->update();
        $name = $cdn->getName();
        $data = array(
            "cdn" => array(
                "name" => $name,
                "libraries" => $libs
            )
        );
        
        $yaml = Yaml::dump($data, 3);
        file_put_contents($data_file, $yaml);

        $this->write(
            "Updated <comment>%s</comment> with <info>%d</info> libraries\n",
            basename($data_file),
            count($libs)
        );

        // write $libs to $this->path/$id.yml

    }

    /**
     * Set the default CDNs. To unset the defaults, pass an empty array.
     *
     */
    public static function setDefaultCdns(array $cdns)
    {
        self::$default_cdns = $cdns;
    }

    /**
     * Write to the output interface using printf style.
     *
     *
     */
    protected function write($fmt, $arg=null)
    {
        $str = (func_num_args() == 1)
                ? $fmt
                : call_user_func_array( "sprintf", func_get_args() )
                ;
        if ($this->output) { 
            $this->output->write($str); 
        }
        if ($this->logger) { 
            $this->logger->debug( strip_tags($str) );
        }
    }

}

// Assign the default CDNs
Manager::setDefaultCdns(array(
    "bootstrapcdn"  => new BootstrapCdn(),
    "cdnjs"         => new Cdnjs(),
));
