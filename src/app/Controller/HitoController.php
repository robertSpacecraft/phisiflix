<?php

namespace App\Controller;

use App\Interface\ControlerInterface;
use App\Model\HitoModel;

class HitoController implements ControlerInterface {

    public function index()
    {
        //Recuperamos los datos de la BD
        $hitos = HitoModel::getAllHitos();

        //Devolvemos el resultado a la vista
        include_once DIRECTORIO_BACKEND . "showHitos.php";
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function store()
    {
        // TODO: Implement store() method.
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