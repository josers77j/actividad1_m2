<?php
include('config.php');
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$dui = $_POST['dui'];
$direccion = $_POST['direccion'];
$email = $_POST['email'];
$status = $_POST['status'];

$stmt = $pdo->prepare('INSERT INTO clientes (nombre, telefono, dui, direccion, email, status) VALUES (:nombre, :telefono, :dui, :direccion, :email, :status)');
if ($stmt->execute(array(
    ':nombre' => $nombre,
    ':telefono' => $telefono,
    ':dui' => $dui,
    ':direccion' => $direccion,
    ':email' => $email,
    ':status' => $status
))) {
} else {
    echo "<script>alert('Error al registrar al cliente');</script>";
}
$conn = null;
