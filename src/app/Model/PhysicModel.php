<?php

namespace App\Model;

use App\Class\Physic;
use PDO;
use PDOException;


class PhysicModel
{
    public static function getAllPhysics(){
        try {
            $conexion = new PDO(URI_SERVIDOR, DATABASE_USERNAME, DATABASE_PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return null;
        }

        $sql = "SELECT * FROM physic";
        $sentenciaPreparada = $conexion->prepare($sql);
        $sentenciaPreparada->execute();

        $resultado = $sentenciaPreparada->fetchAll(PDO::FETCH_ASSOC);
        if ($resultado){
            $physics = [];
            foreach ($resultado as $physic){
                $physics[] = Physic::createFromArray($physic);
            }
            return $physics;
        }
        return null;
    }
}