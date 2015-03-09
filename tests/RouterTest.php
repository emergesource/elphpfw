<?php

use el\Router;

class RouterTest extends PHPUnit_Framework_TestCase
{
    /**
     * Route can be added
     * 
     */
    public function testAddRoute()
    {
        $router = new Router;
        $router->addRoute('route', '/test/route');
        $this->assertArrayHasKey('/test/route', $router->routes);
    }

    /**
     * Can find a match
     * 
     */
    public function testMatch()
    {
        $router = new Router;
        $router->addRoute('route','/test/route');

        // match exists
        $this->assertEquals('route', $router->match('/test/route')->getName());
        $this->assertEquals('/test/route', $router->match('/test/route')->getUri());
    }

    /**
     * A non exestant match should trow an exception
     * 
     * @return void
     */
    public function testBadMatch()
    {
        $this->setExpectedException('el\RouterException');
        $router = new Router;
        $router->match('/test/route');
    }
}



