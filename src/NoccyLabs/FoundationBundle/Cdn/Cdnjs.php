<?php

namespace NoccyLabs\FoundationBundle\Cdn;

use Symfony\Component\Yaml\Yaml;

class Cdnjs implements CdnInterface
{
    public function update($path)
    {
        $temp_file = "/tmp/cdnjs.html.tmp";
        if (file_exists($temp_file)) {
            $html = file_get_contents($temp_file);
        } else {
            $html = file_get_contents("http://cdnjs.com/");
            file_put_contents($temp_file, $html);
        }
        
        $dom = new \DOMDocument();
        @$dom->loadHtml($html);

        $rows = $dom->getElementsByTagName("tr");
        $libs = null;
        
        foreach($rows as $row) {
            $children = $row->getElementsByTagName("td");
            $name = null; $url = null;
            foreach($children as $n=>$row) {
                if ($n == 0) {
                    $name = trim($row->nodeValue);
                    if (strpos($name,"\n")!==false) {
                        list ($name,$void) = explode("\n",$name,2);
                    }
                }
                if ($n == 1) { $url  = trim($row->nodeValue); }
            }
            if ($name && $url) {
                $libs[$name] = array(
                    "url"=>$url
                );
            }
        }
        
        $data = array(
            "cdn" => array(
                "name" => "Cdnjs",
                "libraries" => $libs
            )
        );
        
        $yaml = Yaml::dump($data, 3);
        file_put_contents($path."/cdnjs.yml", $yaml);
        unlink($temp_file);
        
    }

}
