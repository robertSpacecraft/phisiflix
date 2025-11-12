<?php

namespace App\Controller;

use App\Interface\ControlerInterface;
use App\Class\Physic;
use App\Model\PhysicModel;
use App\Model\UserModel;
use Ramsey\Uuid\Rfc4122\UuidV4;
class PhysicController implements ControlerInterface
{
    public function index(){
        //Recuperar todos los usuarios de la base de datos
        $physics = PhysicModel::getAllPhysics();

        //Llamar a la vista que represente a estos usuarios
        include_once DIRECTORIO_BACKEND . "showPhysics.php";
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function store()
    {
        var_dump($_POST);
        var_dump($_FILES);
        uploadImg('foto');
        return true;
    }

    public function update($id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}