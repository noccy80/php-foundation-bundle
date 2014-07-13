<?php

namespace NoccyLabs\FoundationBundle\Cdn;

use Symfony\Component\Yaml\Yaml;

class BootstrapCdn implements CdnInterface
{
    public function update($path)
    {

        $libs = array(
            "twitter-bootstrap-css" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"
            ),
            "twitter-bootstrap" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"
            ),
            "font-awesome" => array(
                "url" => "//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css"
            ),
            "bootswatch-amelia" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/amelia/bootstrap.min.css"
            ),
            "bootswatch-cerulean" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/cerulean/bootstrap.min.css"
            ),
            "bootswatch-cosmo" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/cosmo/bootstrap.min.css"
            ),
            "bootswatch-cyborg" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/cyborg/bootstrap.min.css"
            ),
            "bootswatch-darkly" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/darkly/bootstrap.min.css"
            ),
            "bootswatch-flatly" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/flatly/bootstrap.min.css"
            ),
            "bootswatch-journal" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/journal/bootstrap.min.css"
            ),
            "bootswatch-lumen" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/lumen/bootstrap.min.css"
            ),
            "bootswatch-readable" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/readable/bootstrap.min.css"
            ),
            "bootswatch-simplex" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/simplex/bootstrap.min.css"
            ),
            "bootswatch-slate" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/slate/bootstrap.min.css"
            ),
            "bootswatch-spacelab" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/spacelab/bootstrap.min.css"
            ),
            "bootswatch-superhero" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/superhero/bootstrap.min.css"
            ),
            "bootswatch-united" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/united/bootstrap.min.css"
            ),
            "bootswatch-yeti" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/yeti/bootstrap.min.css"
            ),
        );
        
        $data = array(
            "cdn" => array(
                "name" => "BootstrapCdn",
                "libraries" => $libs
            )
        );
        
        $yaml = Yaml::dump($data, 3);
        file_put_contents($path."/bootstrapcdn.yml", $yaml);
        
    }

}
