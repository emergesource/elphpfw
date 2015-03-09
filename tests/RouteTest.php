<?php

use el\Route;

class RouteTest extends PHPUnit_Framework_TestCase
{
    /**
     * A route should be created with a uri & a name
     * 
     */
    public function testRoute()
    {
        $route = new Route('/testing', 'test');
        $this->assertEquals($route->getName(), 'test');
        $this->assertEquals($route->getUri(), '/testing');
    }

    /**
     * Route uri should have trailing slash removed
     * 
     */
    public function testTrimmedRoute()
    {
        $route = new Route('/testing/', 'test');
        $this->assertEquals($route->getName(), 'test');
        $this->assertEquals($route->getUri(), '/testing');
    }
    
    /**
     * A route can have a target 
     * 
     */
    public function testTarget()
    {
        $route = new Route('/testing', 'test');
        $route->setTarget('application:action');
        $this->assertEquals($route->getTarget(), 'application:action');
    }

    /**
     * Target must be in appliation:action format
     * 
     */
    public function testBadTarget()
    {
        $this->setExpectedException('el\RouteException');
        $route = new Route('/testing', 'test');
        $route->setTarget('applicatoinaction');
    }

    /**
     * Controller should be appliation\views.php
     */
    public function testGetController()
    {
        $route = new Route('/testing', 'test');
        $route->setTarget('application:action');
        $this->assertEquals($route->getController(), 'application\views');
    }

    /**
     * Action name should match
     * 
     */
    public function testGetAction()
    {
        $route = new Route('/testing', 'test');
        $route->setTarget('application:action');
        $this->assertEquals($route->getAction(), 'action');
    }
}
