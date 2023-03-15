<?php
// Conectar a la base de datos
include('../config.php');

// Obtener el término de búsqueda enviado desde la petición AJAX
$termino = $_GET["termino"];

// Hacer la consulta
$sql = "SELECT * FROM clientes WHERE nombre LIKE :termino OR dui LIKE :termino OR telefono LIKE :termino";
$stmt = $pdo->prepare($sql);
$stmt->execute(["termino" => "%$termino%"]);
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolver los resultados en formato JSON
header('Content-Type: application/json');
echo json_encode($resultados);
