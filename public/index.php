<?php

// check for PHP version 5.4 (we use traits)
if (version_compare(PHP_VERSION, '5.4', '<')) {
    exit("ERROR: Requires PHP 5.4 or greater.");
}

// Composer autoloader
include __DIR__ . '/../vendor/autoload.php';

// application config
include __DIR__ .'/../config/app.php';

// load routes
include __DIR__ . '/../config/routes.php';

// di container
include __DIR__ . '/../config/deps.php';

// database settings
$dsn = include __DIR__ . '/../config/db.php';
Metrodb_Connector::setDsn($dsn['name'], $dsn['dsn']);

use Symfony\Component\Routing\Matcher\UrlMatcher;

$matcher = new UrlMatcher($routes, $context);
$requestHandler = new el\RequestHandler($matcher, $di);
$requestHandler->run($request, $response);

$response->send();
