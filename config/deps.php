<?php

use Auryn\Provider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;

$di = new Auryn\Provider;

// http request
$request = Request::createFromGlobals();
$di->share($request);

// http response
$response = new Response;
$di->share($response);

// request context
$context = new RequestContext();
$context->fromRequest($request);
$di->share($context);
