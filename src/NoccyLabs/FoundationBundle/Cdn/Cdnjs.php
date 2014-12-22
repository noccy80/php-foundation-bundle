<?php

namespace NoccyLabs\FoundationBundle\Cdn;

class Cdnjs extends AbstractCdn
{
    public function getName()
    {
        return "Cdnjs";
    }

    public function update()
    {
        $html = $this->getUrlContents("http://cdnjs.com");
        
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
                if (strpos($url,"://")!==false) {
                    $url = substr($url, strpos($url,"://")+1);
                }
                $libs[$name] = array(
                    "url"=>$url
                );
            }
        }
        
        return $libs;
        
    }

}
