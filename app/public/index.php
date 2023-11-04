<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
    //This is where the route will be added.

    $app->get('/', function(Request $request, Response $response){
        $response_array = [
            'message'=> 'Hello RestAPI in Slim Framework'
        ];

        $response_str=json_encode($response_array);

        $response->getBody()->write($response_str);

        return $response;
    });

$app->run();