<?php
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once __DIR__ . '/vendor/autoload.php';

use TECWEB\MYAPI\CREATE\Create;
use TECWEB\MYAPI\READ\Read;
use TECWEB\MYAPI\UPDATE\Update;
use TECWEB\MYAPI\DELETE\Delete;


$app = AppFactory::create();

$app->setBasePath("/tecweb/actividades/API/product_app/backend");

// Middleware para CORS, permite acceso a la API para que los metodos get, post, put y delete sean autorizados 
$app->add(function (Request $request, $handler): Response {
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'Content-Type')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

// Obtener todos los productos
$app->get('/products', function (Request $request, Response $response) {
    $prodObj = new Read('marketzone');
    $prodObj->list();
    $response->getBody()->write($prodObj->getData());
    return $response->withHeader('Content-Type', 'application/json');
});

// Buscar productos por término
$app->get('/products/{search}', function (Request $request, Response $response, array $args) {
    $_GET['search'] = $args['search'];
    $prodObj = new Read('marketzone');
    $prodObj->search($args['search']);
    $response->getBody()->write($prodObj->getData());
    return $response->withHeader('Content-Type', 'application/json');
});

// Obtener un producto por ID
$app->get('/product/{id}', function (Request $request, Response $response, array $args) {
    $_POST['id'] = $args['id'];
    $prodObj = new Read('marketzone');
    $prodObj->single($args['id']);
    $response->getBody()->write($prodObj->getData());
    return $response->withHeader('Content-Type', 'application/json');
});

// Agregar producto
$app->post('/product', function (Request $request, Response $response) {
    $prodObj = new Create('marketzone');
    $prodObj->add(null);
    $response->getBody()->write($prodObj->getData());
    return $response->withHeader('Content-Type', 'application/json');
});

// Editar producto
$app->put('/product', function (Request $request, Response $response) {
    $prodObj = new Update('marketzone');
    $prodObj->edit(null);
    return $response->withHeader('Content-Type', 'application/json');
});

// Eliminar producto
$app->delete('/product/{id}', function (Request $request, Response $response, array $args) {
    $_GET['id'] = $args['id'];
    $prodObj = new Delete('marketzone');
    $prodObj->delete($args['id']);
    $response->getBody()->write($prodObj->getData());
    return $response->withHeader('Content-Type', 'application/json');
});

// Soporte a preflight de CORS, para confirmar cambios antes de las solicitudes. 
$app->options('/{routes:.+}', function (Request $request, Response $response) {
    return $response;
});

$app->run();

?> 