<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();

$routes->add('home', new Route( '/', [
    'controller' => 'home\views', 'action' => 'index'
]));

return $routes;
