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
        //tenemos que validar los datos
        $errores=User::validateUserCreation($_POST);

        if (is_array($errores)) {
            //Se ha producido un error en la validación del usuario
            return include_once DIRECTORIO_BACKEND . "createUser.php";
        } else {
            $usuario = User::createFromArray($_POST);
            //Guardamos en la BD
            UserModel::saveUser($usuario);
            header('Location: /user');
        }

        //Tenemos que guardarlos en la BD
        $usuario = new User(UuidV4::uuid4(),$_POST['username']);

        $usuario->setPassword($_POST['password'])->setEmail($_POST['email']);
        exit;
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

        $resultado = User::validateUserUpdate($put);

        if (is_array($resultado)) {
            http_response_code(422);
            return json_encode([
                "error" => true,
                "mensaje" => "Ha ocurrido un error en la verificación de los datos",
                "data" => $resultado,
                "code" => 422
            ]);
        } else {
            $olduser = UserModel::getUserById($id);
            $newuser = User::editFromArray($olduser, $put);
            //var_dump($newuser);
            UserModel::updateUser($newuser);
            http_response_code(201);
            return json_encode([
                "error" => false,
                "mensaje" => "Datos actualizados correctamente",
                "data" => $newuser,
                "code" => 201
            ]);
        }
        return json_encode($resultado);
    }

    public function destroy($id){
        UserModel::deleteUserById($id);
    }

    public function destroyAll(){
        UserModel::deleteUserAllUsers();
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
                header('location: /admin/welcome');
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