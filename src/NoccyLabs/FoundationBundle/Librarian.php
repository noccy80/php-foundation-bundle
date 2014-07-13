<?php

namespace NoccyLabs\FoundationBundle;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

class Librarian
{
    protected $libraries;

    public function __construct($path=null)
    {
        $this->readLibraries($path);
    }

    public function readLibraries($path=null)
    {
        if (!$path) {
            $path = __DIR__ . "/Resources/cdn";
        }
        $this->libraries = $this->findLibraries($path);
    
    }
    
    public function getLibraries()
    {
        return $this->libraries;
    }
    
    public function getLibraryUrl($library)
    {
        if (!array_key_exists($library,$this->libraries)) {
            throw new \Exception("Requested foundation library {$library} not found");
        }
        $lib = $this->libraries[$library];
        if (count($lib)>1) {
            $lib = $lib[rand(0,count($lib)-1)];
        } else {
            $lib = $lib[0];
        }
        return $lib[1];
    }
    
    protected function findLibraries($path)
    {
        $library = array();
        
        $finder = new \Symfony\Component\Finder\Finder();
        $files = $finder->files()->in($path)->name("*.yml");
        foreach($files as $file) {
            $yaml = file_get_contents($file->getPathname());
            $conf = \Symfony\Component\Yaml\Yaml::parse($yaml);
            if (array_key_exists("cdn",$conf)) {
                if (!array_key_exists("name",$conf['cdn'])) {
                    throw new \Exception("Schema error in {$file->getPathname()}: missing cdn..name");
                }
                if (!array_key_exists("libraries",$conf['cdn'])) {
                    throw new \Exception("Schema error in {$file->getPathname()}: missing cdn..libraries");
                }
                $name = $conf['cdn']['name'];
                $library[$name] = $conf;
            }
        }
        
        $libs_cdn = array();
        foreach($library as $cdn_name=>$cdn) {
            $libs = $cdn['cdn']['libraries'];
            foreach($libs as $lib=>$url) {
                if (!array_key_exists($lib,$libs_cdn)) {
                    $libs_cdn[$lib] = array();
                }
                $libs_cdn[$lib][] = array($cdn_name, $url);
            }
        }
        
        return $libs_cdn;
    
    }

}
