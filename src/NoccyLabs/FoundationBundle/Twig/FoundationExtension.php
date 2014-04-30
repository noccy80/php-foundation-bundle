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
    
    public function foundationFunction()
    {
        // Output the foundation code
        return '';
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
