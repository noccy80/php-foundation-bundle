<?php

namespace NoccyLabs\FoundationBundle\Cdn;

use Symfony\Component\Yaml\Yaml;

class BootstrapCdn implements CdnInterface
{
    public function update($path)
    {
        $vers = "3.3.1";
        $libs = array(
            "twitter-bootstrap-css" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootstrap/{$vers}/css/bootstrap.min.css"
            ),
            "twitter-bootstrap" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootstrap/{$vers}/js/bootstrap.min.js"
            ),
            "font-awesome" => array(
                "url" => "//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"
            ),
            "bootswatch-amelia" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/{$vers}/amelia/bootstrap.min.css"
            ),
            "bootswatch-cerulean" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/{$vers}/cerulean/bootstrap.min.css"
            ),
            "bootswatch-cosmo" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/{$vers}/cosmo/bootstrap.min.css"
            ),
            "bootswatch-cyborg" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/{$vers}/cyborg/bootstrap.min.css"
            ),
            "bootswatch-darkly" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/{$vers}/darkly/bootstrap.min.css"
            ),
            "bootswatch-flatly" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/{$vers}/flatly/bootstrap.min.css"
            ),
            "bootswatch-journal" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/{$vers}/journal/bootstrap.min.css"
            ),
            "bootswatch-lumen" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/{$vers}/lumen/bootstrap.min.css"
            ),
            "bootswatch-paper" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/{$vers}/paper/bootstrap.min.css"
            ),
            "bootswatch-readable" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/{$vers}/readable/bootstrap.min.css"
            ),
            "bootswatch-sandstone" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/{$vers}/sandstone/bootstrap.min.css"
            ),
            "bootswatch-simplex" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/{$vers}/simplex/bootstrap.min.css"
            ),
            "bootswatch-slate" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/{$vers}/slate/bootstrap.min.css"
            ),
            "bootswatch-spacelab" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/{$vers}/spacelab/bootstrap.min.css"
            ),
            "bootswatch-superhero" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/{$vers}/superhero/bootstrap.min.css"
            ),
            "bootswatch-united" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/{$vers}/united/bootstrap.min.css"
            ),
            "bootswatch-yeti" => array(
                "url" => "//maxcdn.bootstrapcdn.com/bootswatch/{$vers}/yeti/bootstrap.min.css"
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
