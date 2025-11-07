<?php

namespace App\Controller;

use App\Class\User;
use App\Enum\UserType;
use App\Interface\ControlerInterface;
use App\Model\UserModel;
use Ramsey\Uuid\Rfc4122\UuidV4;

class UserController implements ControlerInterface
{
    public function index(){
        //Comprobar que es el usuario es de tipo administrador
        if (isset($_SESSION['user']) && $_SESSION['user']->isAdmin()){
            //Recuperar todos los usuarios de la base de datos
            $usuarios = UserModel::getAllUsers();

            //Llamar a la vista que represente a estos usuarios
            include_once DIRECTORIO_BACKEND . "showUsers.php";
        } else {
            $error = "No tiene permisos para acceder a este recurso";
            include_once DIRECTORIO_FRONTEND . "error.php";
        }



    }
    public function show($id){
       //Recuperar los datos del usuario con el valor de la $id desde la BD
        $usuario = UserModel::getUserById($id);

        //Mostrar los datos del usuario con una vista
        include_once DIRECTORIO_BACKEND . "showUser.php";
    }

    //Crear usuario
    public function create(){
        include_once DIRECTORIO_BACKEND . "createUser.php";
    }

    public function store(){
        //Estos son los datos que recibo en la petición post
        //var_dump($_POST);

        //tenemos que validar los datos
        $resultado=User::validateUserCreation($_POST);
        if (is_array($resultado)) {
            //Se ha producido un erro en la validación del usuario
            return include_once DIRECTORIO_BACKEND . "createUser.php";
        } else {
            //No se ha producido ningún error

            //Tenemos que guardarlos en la BD
            //UserModel::saveUser($usuario);

        }

        //Tenemos que guardarlos en la BD
        //UserModel::saveUser($usuario);

        $usuario = new User(UuidV4::uuid4(),$_POST['username']);

        $usuario->setPassword($_POST['password'])->setEmail($_POST['email']);
        var_dump($usuario);
    }

    public function edit($id){
        //Buscamos en la base de datos el usuario con el id $id
        $usuario = UserModel::getUserById($id);

        //Presentamos la vista de edición de usuarios
        include_once DIRECTORIO_BACKEND . "editUser.php";

    }

    public function update($id){
        //Obtenemos los datos de una petición tipo PUT
        $put = json_decode( file_get_contents("php://input"), true);

        $put['id']= $id;
        $resultado=User::validateUserUpdate($put);
        return "Se está intentado editar el usuario $id";
    }

    public function destroy($id){
        return "Se está intentando borrar el usuario $id";
    }

    public function verify(){
        //Buscar en la BD el usuario por su username
        $usuario = UserModel::getUserByUsername($_POST['username']);
        if ($usuario==null) {
            //Esto no le funcionaba al profe, a mi sí
            //include_once DIRECTORIO_FRONTEND."error404.php";
            $error = "Nombre de usuario no encontrado";
        }

        //Comprobar si la contraseña introducida es igual a la que está almacenada
        if (password_verify($_POST['password'], $usuario->getPassword())) {
            $_SESSION['user']=$usuario;
            if ($usuario->getType() === UserType::ADMIN){
                //include_once DIRECTORIO_BACKEND . "admin.php";
                header('location: /user');
            }else {
                //include_once DIRECTORIO_FRONTEND . "welcome.php";
                header('location: /');
            }
        } else {
            $error = "No se ha podido iniciar sesión. Usuario o contraseña no válido";
        }
        include_once DIRECTORIO_BACKEND."login.php";

    }

    public function logout(){
        session_destroy();
    }
}