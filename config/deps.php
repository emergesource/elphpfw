<?php

use Auryn\Provider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$di = new Auryn\Provider;

// http request
$request = Request::createFromGlobals();
$di->share($request);

// http response
$response = new Response;
$di->share($response);
