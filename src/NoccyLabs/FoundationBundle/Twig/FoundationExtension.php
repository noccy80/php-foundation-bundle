<?php

/* 
 * Copyright (C) 2014 NoccyLabs.info
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace NoccyLabs\FoundationBundle\Twig;

/**
 * Twig extension for Page2Images
 */
class FoundationExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('stars', array($this, 'starFilter'), array('is_safe' => array('html'))),
        );
    }
    
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('icon', array($this, 'iconFunction'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('foundation', array($this, 'foundationFunction'), array('is_safe' => array('html')))
        );
    }

    public function starFilter($value, $max=5, $fill_color='gold', $empty_color='gray')
    {
        $out = null;
        for($n = 1; $n <= (int)$max; $n++) {
            $color = urlencode(((int)$value>=$n)?$fill_color:$empty_color);
            $out.= "<span class=\"glyphicon glyphicon-star\" style=\"color:".$color.";\"></span>";
        }
        return $out;
    }
    
    public function iconFunction($icon_classes)
    {
        return '<span class="'.$icon_classes.'"></span>';
    }
    
    public function foundationFunction($modules="jquery,bootstrap")
    {
        $modules = explode(",",$modules);
        $scripts = array();
        $styles  = array();
        
        $lib = new \NoccyLabs\FoundationBundle\Librarian();
        foreach($modules as $module) {
            $url = $lib->getLibraryUrl($module);
            if (preg_match("/\.css$/i", $url)) {
                $styles[] = $url;
            } elseif (preg_match("/\.js$/i", $url)) {
                $scripts[] = $url;
            } else {
                throw new \Exception("Not sure how to add {$url} to document");
            }
        }
        /*
        if (in_array("jquery",$modules)) {
            $scripts[] = "//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js";
        }
        if (in_array("bootstrap",$modules)) {
            $scripts[] = "//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js";
            $styles[]  = "//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css";
        }
        if (in_array("bootstrap-theme",$modules)) {
            $styles[]  = "//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css";
        }
        if (in_array("typeahead",$modules)) {
            $scripts[] = "//cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.1/typeahead.bundle.min.js";
        }
        if (in_array("css-font-awesome",$modules)) {
            $styles[]  = "//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css";
        }
        if (in_array("css-octicons",$modules)) {
            $styles[]  = "//cdnjs.cloudflare.com/ajax/libs/octicons/2.0.2/octicons.css";
        }
        */
        
        $strout = null;
        foreach($styles as $style) {
            $strout .= sprintf("<link rel=\"stylesheet\" type=\"text/css\" href=\"%s\">\n", $style);
        }
        foreach($scripts as $script) {
            $strout .= sprintf("<script type=\"text/javascript\" src=\"%s\"></script>\n", $script);
        }
        
        return $strout;
    }

    /**
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'noccylabsfoundation_extension';
    }
    
}
