<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


require_once __DIR__ . '/../middlewares/jsonBodyParser.php';

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
    
    $result = $queryBuilder->executeQuery()->fetchAll();

    $response->getBody()->write(json_encode($result));

    return $response->withHeader('Content-Type', 'application/json');
});

//3. Display single player
$app->get('/player/{id}', function(Request $request, Response $response,  array $args){
    $queryBuilder = $this->get('DB')->getQueryBuilder();

    $queryBuilder
        ->select('id', 'name', 'team', 'position')
        ->from('players')
        ->where('id=?')
        ->setParameter(1, $args['id']);
        
        $result = $queryBuilder->executeQuery()->fetchAssociative();

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('content-type','application/json');
});

//4. Insert a player
$app->post('/player/add', function(Request $request, Response $response){

    $parsedBody = $request->getParsedBody();

    $queryBuilder = $this->get('DB')->getQueryBuilder();

    $queryBuilder
        ->insert('players')
        ->setValue('name','?')
        ->setValue('team','?')
        ->setValue('position','?')
        ->setParameter(1, $parsedBody['name'])
        ->setParameter(2, $parsedBody['team'])
        ->setParameter(3, $parsedBody['position']);

    $result = $queryBuilder->executeStatement();

    $response->getBody()->write(json_encode($result));
    return $response->withHeader('content-type', 'application/json');
})->add($jsonBodyParser);

//5. Edit player
$app->put('/player/{id}', function(Request $request, Response $response, array $args){

    $parsedBody = $request->getParsedBody();

    $queryBuilder = $this->get('DB')->getQueryBuilder();

    $queryBuilder
        ->update('players')
        ->set('name', '?')
        ->set('team', '?')
        ->set('position', '?')
        ->where('id= ?')
        ->setParameter(1, $parsedBody['name'])
        ->setParameter(2, $parsedBody['team'])
        ->setParameter(3, $parsedBody['position'])
        ->setParameter(4, $args['id']);

        $result = $queryBuilder->executeStatement();

$response->getBody()->write(json_encode($result));
return $response->withHeader('content-type', 'application/json');

})->add($jsonBodyParser);

//6. delete
$app->delete('/player/{id}', function(Request $request, Response $response, array $args){

    $queryBuilder = $this->get('DB')->getQueryBuilder();

    $queryBuilder
        ->delete('players')
        ->where('id=?')
        ->setParameter(1, $args['id'])
        ;

        $results= $queryBuilder->executeStatement();

        $response->getBody()->write(json_encode($results));
        return $response->withHeader('content-type', 'application/json');

});