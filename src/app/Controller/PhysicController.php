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
        //Recuperar todos los physics de la base de datos
        $physics = PhysicModel::getAllPhysics();

        //Llamar a la vista que represente a estos usuarios
        include_once DIRECTORIO_BACKEND . "showPhysics.php";
    }

    public function show($id)
    {
        //Recupero los datos de un physic de la BD
        $physic = PhysicModel::getPhysicById($id);

        //Muestro el resultado en la vista
        include_once DIRECTORIO_BACKEND . "showPhysic.php";
    }

    public function store()
    {
        var_dump($_POST);
        var_dump($_FILES);
        uploadImg('foto');
        return true;
    }
    public function edit($id){
        //Busco en la BD el phisic
        $physic = PhysicModel::getPhysicById($id);

        //Muestro la vista de edición de Physics
        include_once DIRECTORIO_BACKEND . "editPhysic.php";
    }

    public function update($id){

    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}