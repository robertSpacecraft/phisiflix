<?php
    include_once "vendor/autoload.php";
    use Phroute\Phroute\RouteCollector;
    use App\Controller\UserController;

    //Crea una instancia del router
    $router = new RouteCollector();

//Rutas de mi aplicación
//API REST CRUD
$router->get('/user', [UserController::class, 'index']);
$router->get('/user/{id}', [UserController::class, 'show']);
$router->post('/user', [UserController::class, 'store']);
$router->put('/user/{id}', [UserController::class, 'update']);
$router->delete('/user/{id}', [UserController::class, 'destroy']);

$router->get('/physic', [PhysicController::class, 'index']);
$router->get('/physic/{id}', [PhysicController::class, 'show']);
$router->post('/physic', [PhysicController::class, 'store']);
$router->put('/physic/{id}', [PhysicController::class, 'update']);
$router->delete('/physic/{id}', [PhysicController::class, 'destroy']);










    //Definición de rutas frontend:
    $router->get('/', function () {
        include_once "app/views/frontend/welcome.php";
    });

    //Definición de rutas backend
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