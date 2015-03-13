<?php

// use composer autoloader
include __DIR__ . '/../vendor/autoload.php';

include __DIR__ . '/../config/routes.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

$request = Request::createFromGlobals();
$response = new Response;

$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

try {
    $match = $matcher->match($request->getPathInfo());
    
    $class = new $match['controller'];
    $class->$match['action']();

} catch (ResourceNotFoundException $e) {
    $response->setStatusCode('404');
    $response->setContent('Not found');

} catch (Exception $e) {
    $response->setStatusCode('500');
    $response->setContent('An error occured');
}

$response->send();
