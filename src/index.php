<?php
    include_once "vendor/autoload.php";
    include_once "app/env.php";
    include_once "app/auxiliar/funciones-aux.php";

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
   /* $router->any('/', function (){
        include_once "app/views/frontend/error404.php";
    });*/
    $router->get('/', function () {
        include_once DIRECTORIO_FRONTEND."welcome.php";
    });

    //Definición de rutas backend
    $router->get('/admin', function () {
       include_once DIRECTORIO_BACKEND."welcome.php";
    });

    $router->get('/login', function () {
       include_once DIRECTORIO_BACKEND."login.php";
    });

    //Funciones

//Calcula la letra de un DNI que llega por GET (url)
$router->get('/letra-dni', function () {

    $resultado = '';
    if (isset($_GET["dni"])){
        $resultado = calcularLetraDNI($_GET["dni"]);
    } else {
        $resultado = "No se ha recibido ningún parámetro";
    }
});

$router->get('/administracion', function () {});

//Si la ruta no existe lo manda a error404
try {
    $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    echo $response;
} catch (Exception $e) {
    $mensaje = "La página que buscas no existe o ha sido movida.";
    include_once DIRECTORIO_FRONTEND."error404.php";
}
