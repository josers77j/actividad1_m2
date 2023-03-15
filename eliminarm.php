<?php include('config.php'); ?>
<?php
$id = $_GET['id'];
// Eliminar el registro de la base de datos
$stmt = $pdo->prepare("DELETE FROM mascotas WHERE id_mascota = :id");
$stmt->execute(['id' => $id]);

// Redirigir de vuelta a la lista de registros
//header('Location: mascotas.php');
echo "<script>alert('La mascota eliminada correctamente'); 
    window.location = 'mascotas.php';
    </script>";
exit;
