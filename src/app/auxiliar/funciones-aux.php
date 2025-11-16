<?php
declare(strict_types=1);
const LETRAS_DNI = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E'];
function calcularLetraDNI(int $dni): string
{
    return LETRAS_DNI[$dni % 23];
}

function uploadImg(string $campo): bool {
    if (!isset($_FILES[$campo]) || $_FILES[$campo]['error'] !== UPLOAD_ERR_OK) {
        return false;
    }
    $nombre = $_FILES[$campo]['name'];
    $tmpName = $_FILES[$campo]['tmp_name'];
    $destino = __DIR__ . '/../uploaded/physics_img/' . $nombre;

    if (move_uploaded_file($tmpName, $destino)) {
        return true;
    }
    return false;
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
