<?php
// Definir la información de la conexión
$host = 'localhost';
$dbname = 'veterinaria_sv';
$user = 'root';
$password = '';

// Crear una instancia de la clase PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}

// Validar la conexión
$status = $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS);
if ($status === false) {
    die('Error de conexión');
}

//echo 'Conexión exitosa: ' . $status;
