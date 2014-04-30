<?php

/*
 * Copyright (C) 2014, NoccyLabs
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

namespace NoccyLabs\FoundationBundle;

use Symfony\Component\Yaml\Yaml;

/**
 * Description of Component
 *
 * @author noccy
 */
class Component
{
    protected $component;
    
    public function __construct($path)
    {
        $file = file_get_contents($path);
        $this->component = Yaml::parse($file);
    }
    
    public function getName()
    {
        return $this->component["component"]["name"];
    }
    
    public function getVersion()
    {
        return $this->component["component"]["version"];
    }
    
}
