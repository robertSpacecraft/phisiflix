<?php

namespace App\Controller;

use App\Class\User;
use App\Interface\ControlerInterface;
use Ramsey\Uuid\Rfc4122\UuidV4;

class UserController implements ControlerInterface
{
    public function index(){
        return "Me estás pidiendo todos los datos de los usuarios";

    }
    public function show($id){
        return "Me estás pidiendo los datos del usuario $id";
    }

    public function store(){
        var_dump($_POST);

        $usuario = new User(UuidV4::uuid4(),$_POST['username']);

        $usuario->setPassword($_POST['password'])->setEmail($_POST['email']);
        var_dump($usuario);
    }

    public function update($id){

    }

    public function destroy($id){

    }
}