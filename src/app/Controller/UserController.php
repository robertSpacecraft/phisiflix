<?php

namespace App\Controller;

use App\Class\User;
use App\Interface\ControlerInterface;
use App\Model\UserModel;
use Ramsey\Uuid\Rfc4122\UuidV4;

class UserController implements ControlerInterface
{
    public function index(){
       //Recuperar todos los usuarios de la base de datos
        $usuarios = UserModel::getAllUsers();

        //Llamar a la vista que represente a estos usuarios
        include_once DIRECTORIO_BACKEND . "showUsers.php";

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
        var_dump($_POST);
    }
}