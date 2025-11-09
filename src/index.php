<?php
    include_once "vendor/autoload.php";
    include_once "app/env.php";
    include_once "app/auxiliar/funciones-aux.php";

    use Phroute\Phroute\RouteCollector;

    use App\Controller\UserController;
    use App\Controller\PhysicController;

    session_start();

    //Crea una instancia del router
    $router = new RouteCollector();

    //Rutas Frontend
    $router->get('/', function () {
        include_once DIRECTORIO_FRONTEND."welcome.php";
    });

    $router->get('/register', function () {
        include_once DIRECTORIO_FRONTEND."register.php";
    });

    //Definición de rutas backend
    $router->get('/admin', function () {
        include_once DIRECTORIO_BACKEND . "admin.php";
    });
    $router->get('/admin/welcome', function () {
        include_once DIRECTORIO_BACKEND . "admin-welcome.php";
    });
    $router->get('/admin/physics', function () {
        include_once DIRECTORIO_BACKEND . "admin-physics.php";
    });

    $router->get('/login', function () {
        include_once DIRECTORIO_BACKEND."login.php";
    });

//Rutas de mi aplicación
$router->post('/user/login', [UserController::class, 'verify']);
$router->get('/logout', [UserController::class, 'logout']);
$router->get('/user/{id}/edit', [UserController::class, 'edit']);


//API REST CRUD
$router->get('/user/create', [UserController::class, 'create']);
$router->get('/user', [UserController::class, 'index']);
$router->get('/user/{id}', [UserController::class, 'show']);
$router->post('/user', [UserController::class, 'store']);
$router->put('/user/{id}', [UserController::class, 'update']);
$router->delete('/user/{id}', [UserController::class, 'destroy']);

//Physic
$router->get('/admin/physic/create', function () {
    include_once DIRECTORIO_BACKEND."add-Physic.php";
});
$router->get('/admin/physic/{$id}/edit', function ($id) {
    include_once DIRECTORIO_BACKEND."edit-Physic.php";
});

$router->get('/physic', [PhysicController::class, 'index']);
$router->get('/physic/{id}', [PhysicController::class, 'show']);
$router->post('/physic', [PhysicController::class, 'store']);
$router->put('/physic/{id}', [PhysicController::class, 'update']);
$router->delete('/physic/{id}', [PhysicController::class, 'destroy']);


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



//Si la ruta no existe lo manda a error404
try {
    $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    echo $response;
} catch (Exception $e) {
    $mensaje = "La página que buscas no existe o ha sido movida.";
    include_once DIRECTORIO_FRONTEND."error404.php";
}
