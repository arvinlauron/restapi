<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
    //Add routes
 require_once __DIR__ . '/../routes/api.php';
 require_once __DIR__ . '/../routes/web.php';


$app->run();