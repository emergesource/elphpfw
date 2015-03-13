<?php

// use composer autoloader
include __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
$response = new Response;

$response->setStatusCode('404');
$response->setContent('Not Found');

$response->send();

// $routes = require_once('../config/routes.php');
// $router = new el\Router;
// $router->load($routes);
//
// $request = new el\Request($_GET, $_POST, $_SERVER, $_COOKIE);
//
// $requestHandler = new el\RequestHandler($request, $router);
// $requestHandler->run();

