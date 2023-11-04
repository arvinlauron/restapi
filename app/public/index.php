<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;
use DI\Container;
use DI\ContainerBuilder;

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../src/definitions.php');
$container = $containerBuilder->build();

AppFactory::setContainer($container);

$app = AppFactory::create();
    //Add routes
 require_once __DIR__ . '/../routes/api.php';
 require_once __DIR__ . '/../routes/web.php';


$app->run();