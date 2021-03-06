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
        );
    }
    
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('foundation', array($this, 'foundationFunction'), array('is_safe' => array('html')))
        );
    }

    public function foundationFunction($modules="jquery,bootstrap")
    {
        if (!is_array($modules)) {
            $modules = explode(",",$modules);
        }
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
