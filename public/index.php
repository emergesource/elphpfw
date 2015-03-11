<?php

require_once('../vendor/autoload.php');

$routes = require_once('../config/routes.php');
$router = new el\Router;
$router->load($routes);

var_dump($router->getRoutes());
