<?php

namespace App\Model;

use App\Class\Physic;
use PDO;
use PDOException;


class PhysicModel
{
    public static function getAllPhysics()
    {
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
        if ($resultado) {
            $physics = [];
            foreach ($resultado as $physic) {
                $physics[] = Physic::createFromArray($physic);
            }
            return $physics;
        }
        return null;
    }

    public static function getPhysicById($id): ?Physic
    {
        try {
            $conexion = new PDO(URI_SERVIDOR, DATABASE_USERNAME, DATABASE_PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return null;
        }

        $sql = "SELECT * FROM physic WHERE id = ?";
        $sentenciaPreparada = $conexion->prepare($sql);
        $sentenciaPreparada->bindValue(1, $id);
        $sentenciaPreparada->execute();

        $resultado = $sentenciaPreparada->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            $physic = Physic::createFromArray($resultado);
            return $physic;
        } else {
            return null;
        }
    }

    public static function savePhysic(Physic $physic): bool
    {
        try {
            $conexion = new PDO(URI_SERVIDOR, DATABASE_USERNAME, DATABASE_PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return false;
        }

        $sql = "INSERT INTO physic (id, nombre, apellido, genero, nacionalidad, lugar_def, descripcion, etiqueta, type, foto) 
                    VALUES (:id, :nombre, :apellido, :genero, :nacionalidad, :lugar_def, :descripcion, :etiqueta, :type, :foto)";

        $sentenciaPreparada = $conexion->prepare($sql);
        $sentenciaPreparada->bindValue(":id", $physic->getId());
        $sentenciaPreparada->bindValue(":nombre", $physic->getNombre());
        $sentenciaPreparada->bindValue(":apellido", $physic->getApellido());
        $sentenciaPreparada->bindValue(":genero", $physic->getGenero()->name);
        $sentenciaPreparada->bindValue(":nacionalidad", $physic->getNacionalidad());
        $sentenciaPreparada->bindValue(":lugar_def", $physic->getLugarDef());
        $sentenciaPreparada->bindValue(":descripcion", $physic->getDescripcion());
        $sentenciaPreparada->bindValue(":etiqueta", $physic->getEtiqueta());
        $sentenciaPreparada->bindValue(":type", $physic->getType()->name);
        $sentenciaPreparada->bindValue(":foto", $physic->getFoto());
        $sentenciaPreparada->execute();

        if ($sentenciaPreparada->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public static function updatePhysic(Physic $physic): bool
    {
        try {
            $conexion = new PDO(URI_SERVIDOR, DATABASE_USERNAME, DATABASE_PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return false;
        }

        $sql = "UPDATE physic SET nombre = :nombre, apellido = :apellido, genero = :genero, nacionalidad = :nacionalidad,
                  lugar_def = :lugar_def, descripcion = :descripcion, etiqueta = :etiqueta, type = :type, foto = :foto
                  WHERE id = :id";

        $sentenciaPreparada = $conexion->prepare($sql);
        $sentenciaPreparada->bindValue("id", $physic->getId());
        $sentenciaPreparada->bindValue("nombre", $physic->getNombre());
        $sentenciaPreparada->bindValue("apellido", $physic->getApellido());
        $sentenciaPreparada->bindValue("genero", $physic->getGenero()->name);
        $sentenciaPreparada->bindValue("nacionalidad", $physic->getNacionalidad());
        $sentenciaPreparada->bindValue("lugar_def", $physic->getLugarDef());
        $sentenciaPreparada->bindValue("descripcion", $physic->getDescripcion());
        $sentenciaPreparada->bindValue("etiqueta", $physic->getEtiqueta());
        $sentenciaPreparada->bindValue("type", $physic->getType()->name);
        $sentenciaPreparada->bindValue("foto", $physic->getFoto());

        $sentenciaPreparada->execute();

        if ($sentenciaPreparada->rowCount() > 0) {
            return true;
        }
        return false;
    }
}