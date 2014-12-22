<?php

namespace NoccyLabs\FoundationBundle\Cdn;

class BootstrapCdn extends AbstractCdn
{
    public function getName()
    {
        return "BootstrapCdn";
    }

    protected function updateBootswatch($dom)
    {
        $divs = $dom->getElementsByTagName("div");
        $libs = array();
        
        foreach ($divs as $div) {
            if ((string)$div->getAttribute('class') == "bootswatch") {
                $tmp = $div->firstChild->getAttribute("href");
                $id  = "bootswatch-" . basename($tmp);
                foreach ($div->childNodes as $sdiv) {
                    if ((string)$sdiv->getAttribute('class') == "input-group") {
                        $url = $sdiv->firstChild->getAttribute("value");
                        $libs[$id] = array(
                            "url" => $url
                        );
                    }
                }
            }
        }
        
        return $libs;
    }

    protected function updateBootstrap($dom)
    {
        $vers = "3.3.1";
        $libs = array(
            "twitter-bootstrap-css" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootstrap/{$vers}/css/bootstrap.min.css"
            ),
            "twitter-bootstrap" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootstrap/{$vers}/js/bootstrap.min.js"
            ),
        );    
        return $libs;
    }
    
    protected function updateFontAwesome($dom)
    {
        $libs = array(
            "font-awesome" => array(
                "url" => "//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"
            ),
        );    
        return $libs;
    }

    public function update()
    {
        $html = $this->getUrlContents("http://www.bootstrapcdn.com");
        
        $dom = new \DOMDocument();
        @$dom->loadHtml($html);

        $libs = array_merge(
            $this->updateBootswatch($dom),
            $this->updateBootstrap($dom),
            $this->updateFontAwesome($dom)
        );
        
        return $libs;
        
        
    }

}
