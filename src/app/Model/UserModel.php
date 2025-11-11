<?php

namespace App\Model;

use App\Class\User;
use App\Enum\UserType;
use mysql_xdevapi\TableUpdate;
use PDO;
use PDOException;
use Ramsey\Uuid\Nonstandard\Uuid;
class UserModel
{
    public static function getAllUsers():?array{
        try {
            $conexion = new PDO(URI_SERVIDOR, DATABASE_USERNAME, DATABASE_PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return null;
        }

        $sql = "SELECT * FROM user";
        $sentenciaPreparada = $conexion->prepare($sql);
        $sentenciaPreparada->execute();

        $resultado = $sentenciaPreparada->fetchAll(PDO::FETCH_ASSOC);

        if ($resultado){
            $usuarios = [];
            foreach ($resultado as $user) {
                $usuarios[] = User::createFromArray($user);
            }
            return $usuarios;

        } else {
            return null;
        }

    }

    public static function saveUser(User $user):bool{
        try {
            $conexion = new PDO(URI_SERVIDOR, DATABASE_USERNAME, DATABASE_PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return false;
        }

        $sql = "INSERT INTO user values(:id, :username, :email, :password, STR_TO_DATE(:birthdate, '%Y-%c-%d'), :type)";
        $sentenciaPreparada = $conexion->prepare($sql);
        $sentenciaPreparada->bindValue("id", $user->getId());
        $sentenciaPreparada->bindValue("username", $user->getUsername());
        $sentenciaPreparada->bindValue("email", $user->getEmail());
        $sentenciaPreparada->bindValue("password", $user->getPassword());
        $sentenciaPreparada->bindValue("birthdate", $user->getBirthdate()->format("Y-m-d"));
        $sentenciaPreparada->bindValue("type", $user->getType()->name);
        $sentenciaPreparada->execute();

        if ($sentenciaPreparada->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public static function getUserById($id):?User{
        try {
            $conexion = new PDO(URI_SERVIDOR, DATABASE_USERNAME, DATABASE_PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return false;
        }
        $sql = "SELECT * FROM user WHERE id = ?";
        $sentenciaPreparada = $conexion->prepare($sql);
        $sentenciaPreparada->bindValue(1, $id);
        $sentenciaPreparada->execute();

        $resultado = $sentenciaPreparada->fetch(PDO::FETCH_ASSOC);

        if ($resultado){
            $usuario = User::createFromArray($resultado);
            return $usuario;
        } else{
            return null;
        }
    }

    public static function getUserByUsername(string $username): ?User{
        try {
            $conexion = new PDO(URI_SERVIDOR, DATABASE_USERNAME, DATABASE_PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return false;
        }
        $sql = "SELECT * FROM user WHERE username = ?";
        $sentenciaPreparada = $conexion->prepare($sql);
        $sentenciaPreparada->bindValue(1, $username);
        $sentenciaPreparada->execute();

        $resultado = $sentenciaPreparada->fetch(PDO::FETCH_ASSOC);

        if ($resultado){
            $usuario = User::createFromArray($resultado);
            return $usuario;
        } else{
            return null;
        }
    }

    public static function getUserByEmail(string $email):?User{
        try {
            $conexion = new PDO(URI_SERVIDOR, DATABASE_USERNAME, DATABASE_PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return false;
        }
        $sql = "SELECT * FROM user WHERE email = ?";
        $sentenciaPreparada = $conexion->prepare($sql);
        $sentenciaPreparada->bindValue(1, $email);
        $sentenciaPreparada->execute();

        $resultado = $sentenciaPreparada->fetch(PDO::FETCH_ASSOC);

        if ($resultado){
            $usuario = User::createFromArray($resultado);
            return $usuario;
        } else{
            return null;
        }
    }

    public static function deleteUserById($id):bool{
        try {
            $conexion = new PDO(URI_SERVIDOR, DATABASE_USERNAME, DATABASE_PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return false;
        }
        $sql = "DELETE FROM user WHERE id = ?";
        $sentenciaPreparada = $conexion->prepare($sql);
        $sentenciaPreparada->bindValue(1, $id);
        $sentenciaPreparada->execute();

        if ($sentenciaPreparada->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function deleteUserAllUsers():bool{
        try {
            $conexion = new PDO(URI_SERVIDOR, DATABASE_USERNAME, DATABASE_PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return false;
        }
        $sql = "TRUNCATE user";
        $sentenciaPreparada = $conexion->prepare($sql);
        $sentenciaPreparada->bindValue(1, $id);
        $sentenciaPreparada->execute();

        if ($sentenciaPreparada->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }


    public static function updateUser(User $user): bool{
        try {
            $conexion = new PDO(URI_SERVIDOR, DATABASE_USERNAME, DATABASE_PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return false;
        }
        $sql = "UPDATE user SET username =: username, email =: email, password =: password, birthdate = STR_TO_DATE(:birthdate, '%Y-%c-%d'), type=: type WHERE id = :id";
        $sentenciaPreparada = $conexion->prepare($sql);
        $sentenciaPreparada->bindValue("id", $user->getId());
        $sentenciaPreparada->bindValue("username", $user->getUsername());
        $sentenciaPreparada->bindValue("email", $user->getEmail());
        $sentenciaPreparada->bindValue("password", $user->getPassword());
        $sentenciaPreparada->bindValue("birthdate", $user->getBirthdate()->format("Y-m-d"));
        $sentenciaPreparada->bindValue("type", $user->getType()->name);

        $sentenciaPreparada->execute();

        if ($sentenciaPreparada->rowCount() > 0) {
            return true;
        }
        return false;
     }

}