<?php

use el\Request;

class RequestTest extends PHPUnit_Framework_TestCase
{
    protected $request;

    public function setUp()
    {
        $this->request = new Request(
            array('gettest' => 'abc'), 
            array('posttest' => 'def'), 
            array(
                'REQUEST_METHOD' => 'get', 
                'REQUEST_URI' => '/',
                'QUERY_STRING' => '?id=123'
            ), 
            array()
        );    
    }
    
    /**
     * Get param  
     */
    public function testGetParam()
    {
        // default value
        $this->assertEquals(
            $this->request->getParam('unknown', 'default'), 
            'default'
        );

        // empty default is null
        $this->assertNull($this->request->getParam('unknown'));

        // GET param
        $this->assertEquals($this->request->getParam('gettest'), 'abc');

        // POST param
        $this->assertEquals($this->request->getParam('posttest'), 'def');
    }
    
    /**
     * Both get & test params are included in params array
     */
    public function testGetParams()
    {
        $this->assertArrayHasKey('gettest', $this->request->getParams());
        $this->assertArrayHasKey('posttest', $this->request->getParams());
    }

    /**
     * Get method returns server method
     * 
     */
    public function getGetMethod()
    {
        $this->assertEquals($this->request->getMethod(), 'get');
    }

    /**
     * getUri returns request uri
     */
    public function testGetUri()
    {
        $this->assertEquals($this->request->getUri(), '/');
    }

    /**
     * getQueryString returns query string 
     */
    public function testGetQueryString()
    {
        $this->assertEquals($this->request->getQueryString(), '?id=123');
    }
}
