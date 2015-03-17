<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();

$routes->add('default', new Route( '/', [
    'controller' => 'home\views', 
    'action' => 'index'
]));

$routes->add('home', new Route( '/home', [
    'controller' => 'home\views', 
    'action' => 'home'
]));

$routes->add('test', new Route( '/home/test', [
    'controller' => 'home\controller\test', 
    'action' => 'index'
]));


return $routes;
