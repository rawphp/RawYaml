<?php

/**
 * This file is part of RawPHP - a PHP Framework.
 * 
 * Copyright (c) 2014 RawPHP.org
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 * 
 * PHP version 5.4
 * 
 * @category  PHP
 * @package   RawPHP/RawYaml
 * @author    Tom Kaczohca <tom@rawphp.org>
 * @copyright 2014 Tom Kaczocha
 * @license   http://rawphp.org/license.txt MIT
 * @link      http://rawphp.org/
 */

namespace RawPHP\RawYaml;

use RawPHP\RawBase\Component;
use RawPHP\RawMail\IYaml;
use RawPHP\RawYaml\YamlException;
use Symfony\Component\Yaml\Yaml as SymFonyYaml;

/**
 * Yaml parser and dumper service.
 * 
 * The current implementation is just a wrapper over the Symfony's Yaml library.
 * 
 * @category  PHP
 * @package   RawPHP/RawYaml
 * @author    Tom Kaczocha <tom@rawphp.org>
 * @copyright 2014 Tom Kaczocha
 * @license   http://rawphp.org/license.txt MIT
 * @link      http://rawphp.org/
 * @see       https://github.com/Synchro/PHPMailer
 */
class Yaml extends Component implements IYaml
{
    /**
     * Dumps an array as yaml.
     * 
     * @param array $array the array to dump
     */
    public function dump( $array )
    {
        echo SymFonyYaml::dump( $array );
    }
    
    /**
     * Parses yaml file and returns an array.
     * 
     * @param string $file the yaml file.
     * 
     * @fitler ON_YAML_LOAD_FILTER(2)
     * 
     * @return array the configuration array
     */
    public function load( $file )
    {
        $retVal = array( );
        
        try
        {
            $retVal = SymFonyYaml::parse( $file );
        }
        catch ( Exception $e )
        {
            throw new YamlException( $e->getmessage( ), $e->getCode( ), $e );
        }
        
        return $this->filter( self::ON_YAML_LOAD_FILTER, $retVal, $file );
    }
    
    /**
     * Save array as yml to file.
     * 
     * @param array  $array the array to save
     * @param string $file  file path
     * 
     * @filter ON_YAML_SAVE_FILTER(3)
     * 
     * @throws YamlException on saving problems
     */
    public function save( $array, $file )
    {
        try
        {
            ob_start( );
            
            $this->dump( $array );
            
            $data = ob_get_clean( );

            file_put_contents( $file, $this->filter( self::ON_YAML_SAVE_FILTER, $data, $array, $file ) );
        }
        catch ( Exception $e )
        {
            throw new YamlException( $e->getMessage( ), $e->getCode( ), $e );
        }
    }
    
    const ON_YAML_LOAD_FILTER = 'on_yaml_load_filter';
    const ON_YAML_SAVE_FILTER  = 'on_yaml_save_filter';
}