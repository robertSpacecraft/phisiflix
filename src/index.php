<?php
    include_once "vendor/autoload.php";
    use Phroute\Phroute\RouteCollector;
    $router = new RouteCollector();

    //Definición de rutas:
    $router->get('/', function () {
        include_once "app/views/frontend/welcome.php";
    });

    $router->get('/admin', function () {
       include_once "app/views/backend/welcome.php";
    });

    $router->get('/login', function () {
       include_once "app/views/backend/login.php";
    });

# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Print out the value returned from the dispatched function
echo $response;