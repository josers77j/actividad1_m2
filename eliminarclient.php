<?php include('config.php'); ?>
<?php
$id = $_GET['id'];
// Eliminar el registro de la base de datos
$stmt = $pdo->prepare("DELETE FROM clientes WHERE id_cliente = :id");
$stmt->execute(['id' => $id]);

// Redirigir de vuelta a la lista de registros
//header('Location: clientes.php');
echo "<script>alert('El Cliente ha sido eliminado correctamente'); 
    window.location = 'clientes.php';
    </script>";
exit;
