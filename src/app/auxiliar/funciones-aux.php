<?php
declare(strict_types=1);
const LETRAS_DNI = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E'];
function calcularLetraDNI(int $dni): string
{
    return LETRAS_DNI[$dni % 23];
}

function uploadImg($foto)
{
    $base = dirname(__DIR__);
    $directorio = scandir($base);

    //Si no existe uploaded lo creo
    if (!in_array('uploaded', $directorio)) {
        mkdir($base . '/uploaded');
    }

    //Si no existe physics_img lo creo
    $subdir = $base . '/uploaded/physics_img';
    if (!is_dir($subdir)) {
        mkdir($subdir);
    }

    //Subo la imagen a physics_img
    $directorioDestino = $subdir . '/' . $_FILES[$foto]['name'];
    move_uploaded_file($_FILES[$foto]['tmp_name'], $directorioDestino);
}

//Función para obtener la conexión:
function getConnexion(): ?PDO{
    try {
        $conexion = new PDO(URI_SERVIDOR, DATABASE_USERNAME, DATABASE_PASSWORD);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        return null;
    }
}
