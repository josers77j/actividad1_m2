<?php
// Establecer la conexión a la base de datos
include('../config.php');
// Obtener el ID del cliente a eliminar
$idCliente = $_GET["id"];

// Preparar la consulta SQL para eliminar al cliente
$sql = "DELETE FROM clientes WHERE id_cliente = :id";
$consulta = $pdo->prepare($sql);
$consulta->bindParam(":id", $idCliente);

// Ejecutar la consulta SQL y verificar si se eliminó el cliente correctamente
try {
    $consulta->execute();
    if ($consulta->rowCount() == 1) {
        echo "Cliente eliminado correctamente";
    } else {
        echo "No se encontró ningun cliente con el ID especificado";
    }
} catch (PDOException $e) {
    echo "Error al eliminar al cliente: " . $e->getMessage();
}
