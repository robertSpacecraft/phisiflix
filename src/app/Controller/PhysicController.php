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

    public function store() {
        //Como tengo un archivo de foto he tenido que realizar diversas modificacione con la ayuda de chatgpt
        header('Content-Type: application/json; charset=utf-8');
        //Combino datos de texto + nombre del fichero
        $datos = $_POST;

        //Para validar, uso SOLO el nombre de archivo de la imagen para validar
        if (!empty($_FILES['foto']['name'])) {
            $datos['foto'] = $_FILES['foto']['name'];
        } else {
            $datos['foto'] = "";
        }
        //Valido
        $resultado = Physic::validatePhysicCreation($datos);
        if (is_array($resultado)) {
            http_response_code(422);
            echo json_encode([
                "error"   => true,
                "mensaje" => "Ha ocurrido un error en la verificación de los datos",
                "data"    => $resultado,
                "code"    => 422
            ]);
            return;
        }
        //Si todo es correcto, creo objeto Physic desde los datos
        $physic = Physic::createFromArray($datos);
        //Lo guardo en la BD
        $ok = PhysicModel::savePhysic($physic);
        //Subo la imagen usando la función uploadImg
        uploadImg('foto');

        // 6. Respuesta de éxito
        http_response_code(201);
        echo json_encode([
            "error"   => false,
            "mensaje" => "Físico creado correctamente",
            "data"    => null,
            "code"    => 201
        ]);
    }

    public function edit($id){
        //Busco en la BD el physic
        $physic = PhysicModel::getPhysicById($id);

        //Muestro la vista de edición de Physics
        include_once DIRECTORIO_BACKEND . "editPhysic.php";
    }

    public function update($id) {
        header('Content-Type: application/json; charset=utf-8');
        //Obtengo los datos de la petición PUT
        $put = json_decode(file_get_contents("php://input"), true) ?? [];
        $put['id'] = $id;
        //Valido los datos, si no son correctos devolverá un array con el error
        $resultado = Physic::validatePhysicCreation($put);
        if (is_array($resultado)) {
            //Si es un array es porque ha habido algún error y entrará aquí
            http_response_code(422);
            echo json_encode([
                "error"   => true,
                "mensaje" => "Ha ocurrido un error en la verificación de los datos",
                "data"    => $resultado,
                "code"    => 422
            ]);
            return;
        }
        //Recupero los datos del físico de la BD
        $oldPhysic = PhysicModel::getPhysicById($id);
        //Edito los datos con el array recibido
        $newPhysic = Physic::editFromArray($oldPhysic, $put);
        //Actualizo la BD
        $ok = PhysicModel::updatePhysic($newPhysic);
        if (!$ok) {
            http_response_code(500);
            echo json_encode([
                "error"   => true,
                "mensaje" => "No se ha podido actualizar el físico en la base de datos",
                "data"    => null,
                "code"    => 500
            ]);
            return;
        }
        http_response_code(200);
        echo json_encode([
            "error"   => false,
            "mensaje" => "Datos actualizados correctamente",
            "data"    => [   // si quieres simplificar, puedes no mandar el objeto entero
                "id"           => (string) $newPhysic->getId(),
                "nombre"       => $newPhysic->getNombre(),
                "apellido"     => $newPhysic->getApellido(),
                "genero"       => $newPhysic->getGenero()->name,
                "nacionalidad" => $newPhysic->getNacionalidad(),
                "lugar_def"    => $newPhysic->getLugarDef(),
                "descripcion"  => $newPhysic->getDescripcion(),
                "etiqueta"     => $newPhysic->getEtiqueta(),
                "type"         => $newPhysic->getType()->name,
                "foto"         => $newPhysic->getFoto(),
            ],
            "code"    => 200
        ]);
    }

    public function destroy($id) {
        PhysicModel::deletePhysicById($id);
    }

    public function destroyAll(){
        PhysicModel::deletePhysicAllPhyics();
    }
}