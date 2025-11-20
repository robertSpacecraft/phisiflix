<?php

namespace App\Model;
use App\Class\Hito;
use PDO;
use PDOException;


class HitoModel {
    public static function getAllHitos(){
        try {
            $conexion = new PDO(URI_SERVIDOR, DATABASE_USERNAME, DATABASE_PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return null;
        }

        $sql = "SELECT * FROM hitos";
        $sentenciaPreparada = $conexion->prepare($sql);
        $sentenciaPreparada->execute();

        $resultado = $sentenciaPreparada->fetchAll(PDO::FETCH_ASSOC);
        if ($resultado) {
            $hitos = [];
            foreach ($resultado as $hito) {
                $hitos[] = Hito::createFromArray($hito);
            }
            return $hitos;
        } else {
            return null;
        }
    }

}