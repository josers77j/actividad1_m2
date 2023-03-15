<?php
// Establecer la conexión a la base de datos
include('../config.php');
// Obtener el ID de la mascota a eliminar
$idMascota = $_GET["id"];

// Preparar la consulta SQL para eliminar la mascota
$sql = "DELETE FROM mascotas WHERE id_mascota = :id";
$consulta = $pdo->prepare($sql);
$consulta->bindParam(":id", $idMascota);

// Ejecutar la consulta SQL y verificar si se eliminó la mascota correctamente
try {
    $consulta->execute();
    if ($consulta->rowCount() == 1) {
        echo "Mascota eliminada correctamente";
    } else {
        echo "No se encontró ninguna mascota con el ID especificado";
    }
} catch (PDOException $e) {
    echo "Error al eliminar la mascota: " . $e->getMessage();
}
