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
 * PHP version 5.3
 * 
 * @category  PHP
 * @package   RawPHP/RawYaml
 * @author    Tom Kaczohca <tom@rawphp.org>
 * @copyright 2014 Tom Kaczocha
 * @license   http://rawphp.org/license.txt MIT
 * @link      http://rawphp.org/
 */

namespace RawPHP\RawYaml;

use RawPHP\RawYaml\Yaml;

/**
 * Yaml class tests.
 * 
 * @category  PHP
 * @package   RawPHP/RawYaml
 * @author    Tom Kaczocha <tom@rawphp.org>
 * @copyright 2014 Tom Kaczocha
 * @license   http://rawphp.org/license.txt MIT
 * @link      http://rawphp.org/
 */
class YamllTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Yaml
     */
    public $yaml;
    /**
     * @var array
     */
    private $_files = array( 'array.yml', 'dictionary.yml', 'complex.yml' );
    
    /**
     * Setup before each test.
     */
    public function setup( )
    {
        $this->yaml = new Yaml( );
    }
    
    /**
     * Cleanup after each test.
     */
    public function tearDown( )
    {
        $this->yaml = NULL;
        
        foreach( $this->_files as $file )
        {
            if ( file_exists( OUTPUT_DIR . $file ) )
            {
                unlink( OUTPUT_DIR . $file );
            }
        }
    }
    
    /**
     * Test log instantiated correctly.
     */
    public function testMailInstantiatedSuccessfully( )
    {
        $this->assertNotNull( $this->yaml );
    }
    
    /**
     * Test parsing dictionary yaml file.
     */
    public function testLoadDictionaryYaml( )
    {
        $array = $this->yaml->load( SUPPORT_DIR . 'dictionary.yml' );
        
        $this->assertContains( 'name', array_keys( $array ) );
        $this->assertContains( 'email', array_keys( $array ) );
    }
    
    /**
     * Test parsing array yaml file.
     */
    public function testLoadArray( )
    {
        $array = $this->yaml->load( SUPPORT_DIR . 'list.yml' );
        
        $this->assertContains( 'Apple', $array );
        $this->assertContains( 'Orange', $array );
        $this->assertContains( 'Bannana', $array );
    }
    
    /**
     * Test a complex example.
     */
    public function testLoadComplexArray( )
    {
        $array = $this->yaml->load( SUPPORT_DIR . 'complex.yml' );
        
        Yaml::arrayDump( $array );
        
        $this->assertEquals( 'Example Developer', $array[ 'name' ] );
        $this->assertEquals( 'Developer', $array[ 'job' ] );
        $this->assertEquals( 'Elite', $array[ 'skill' ] );
        $this->assertEquals( TRUE, $array[ 'employed' ] );
        
        $foods = $array[ 'foods' ];
        
        $this->assertContains( 'Apple', $foods );
        $this->assertContains( 'Orange', $foods );
        $this->assertContains( 'Strawberry', $foods );
        $this->assertContains( 'Mango', $foods );
        
        $lang = $array[ 'languages' ];
        
        $this->assertContains( 'python', array_keys( $lang ) );
        $this->assertContains( 'ruby', array_keys( $lang ) );
        $this->assertContains( 'donet', array_keys( $lang ) );
    }
    
    /**
     * Test saving an array to yaml.
     */
    public function testSaveArrayToYaml( )
    {
        $file = OUTPUT_DIR . 'array.yml';
        
        $array = array( 'this', 'that', 'and', 'all', 'this' );
        
        $this->yaml->save($array, $file );
        
        $this->assertEquals(
"- this
- that
- and
- all
- this
",
 file_get_contents( $file ) );
    }
    
    /**
     * Test saving a dictionary to yaml.
     */
    public function testSaveDictionaryToYaml( )
    {
        $file = OUTPUT_DIR . 'dictionary.yml';
        
        $array = array( 
            'name'  => 'John Smith',
            'job'   => 'Developer',
            'skill' => 'Elite',
        );
        
        $this->yaml->save($array, $file );
        
        $this->assertEquals(
"name: 'John Smith'
job: Developer
skill: Elite
",
 file_get_contents( $file ) );
    }
    
    /**
     * Test saving a complex example to yaml.
     */
    public function testSavingAComplexExampleToYaml( )
    {
        $file = OUTPUT_DIR . 'complex.yml';
        
        $array = array( 
            'name'  => 'John Smith',
            'job'   => 'Developer',
            'skill' => 'Elite',
            'languages' => array( 
                'python' => 'Elite',
                'ruby'   => 'Lame',
                'dotnet' => 'Elite',
            ),
            'extra' => 'Something of interest here',
            'list'  => array( 'this', 'that', 'and', 'all', 'this' ),
        );
        
        $this->yaml->save($array, $file );
        
        $this->assertEquals(
"name: 'John Smith'
job: Developer
skill: Elite
languages:
    python: Elite
    ruby: Lame
    dotnet: Elite
extra: 'Something of interest here'
list:
    - this
    - that
    - and
    - all
    - this
",
 file_get_contents( $file ) );
    }
}