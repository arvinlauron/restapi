<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
//All api routes will be encoded

//1. Home route
$app->get('/', function(Request $request, Response $response){
    $response_array = [
        'message'=> 'Hello RestAPI in Slim Framework'
    ];

    $response_str=json_encode($response_array);

    $response->getBody()->write($response_str);

    return $response->withHeader('Content-Type', 'application/json');
});

//2. Display all players
$app->get('/players', function(Request $request, Response $response){
    //connect to the database using doctrine DBAL
    $queryBuilder = $this->get('DB')->getQueryBuilder();

    $queryBuilder
        ->select('id', 'name', 'team', 'position')
        ->from('players')
    ;
    
    $results = $queryBuilder->executeQuery()->fetchAll();

    $response->getBody()->write(json_encode($results));

    return $response->withHeader('Content-Type', 'application/json');
});