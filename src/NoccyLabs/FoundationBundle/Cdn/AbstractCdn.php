<?php

namespace NoccyLabs\FoundationBundle\Cdn;

use Symfony\Component\Yaml\Yaml;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractCdn implements LoggerAwareInterface, CdnInterface
{

    /**
     * @var Psr\Log\LoggerInterface The assigned interface for logging
     */
    protected $logger;
    
    protected $output;

    /**
     * Update the logger to use
     *
     * @param Psr\Log\LoggerInterface New logger interface or NULL to unset
     */
    public function setLogger(LoggerInterface $logger=NULL)
    {
        $this->logger = $logger;
    }
    
    public function setOutput(OutputInterface $output=NULL)
    {
        $this->output = $output;
    }

    protected function write($fmt, $arg=null)
    {
        $str = (func_num_args() == 1)
                ? $fmt
                : call_user_func_array( "sprintf", func_get_args() )
                ;
        if ($this->output) { $this->output->write($str); }
    }

    protected function getUrlContents($url)
    {
        $temp_dir = sys_get_temp_dir();
        $md5_file = md5($url);
        $temp_file = "{$temp_dir}/{$md5_file}.html";
        
        if (file_exists($temp_file)) {
            $age = (time() - filemtime($temp_file));
            if ($age < 600) {
                $html = file_get_contents($temp_file);
                return $html;
            } else {
                unlink($temp_file);
            }
        } 

        $html = file_get_contents($url);
        if (is_writable(dirname($temp_file))) {
            file_put_contents($temp_file, $html);
        }
        return $html;
    }
}
