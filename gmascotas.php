<?php
include('config.php');
$nombre = $_POST['nombre'];
$raza = $_POST['raza'];
$color = $_POST['color'];
$peso = $_POST['peso'];
$altura = $_POST['altura'];
$sexo = $_POST['sexo'];
$fech_nacimiento = $_POST['fech_nacimiento'];

$stmt = $pdo->prepare('INSERT INTO mascotas (nombre, raza, color, peso, altura, sexo, fech_nacimiento) VALUES (:nombre, :raza, :color, :peso, :altura, :sexo, :fech_nacimiento)');
if ($stmt->execute(array(
    ':nombre' => $nombre,
    ':raza' => $raza,
    ':color' => $color,
    ':peso' => $peso,
    ':altura' => $altura,
    ':sexo' => $sexo,
    ':fech_nacimiento' => $fech_nacimiento
))) {
} else {
    echo "<script>alert('Error al registrar la mascota');</script>";
}
$conn = null;
