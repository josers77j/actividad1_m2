<!doctype html>
<html lang="en">
<?php include('menu.php'); ?>
<?php include('config.php'); ?>
<?php
$id = $_GET['id'];
// Obtener los datos actuales del registro
$stmt = $pdo->prepare("SELECT * FROM clientes WHERE id_cliente = :id");
$stmt->execute(['id' => $id]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $dui = $_POST['dui'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $status = $_POST['status'];

    // Actualizar el registro en la base de datos
    $stmt = $pdo->prepare("UPDATE clientes SET nombre = :nombre, 
                                                telefono = :telefono, 
                                                dui = :dui, 
                                                direccion = :direccion, 
                                                email = :email, 
                                                status = :status
                                                WHERE id_cliente = :id");
    $stmt->execute([
        'nombre' => $nombre,
        'telefono' => $telefono,
        'dui' => $dui,
        'direccion' => $direccion,
        'email' => $email,
        'status' => $status,
        'id' => $id
    ]);

    // Redirigir de vuelta a la lista de registros
    echo "<script>alert('El cliente fue actualizado correctamente'); 
    window.location = 'editarm.php?id=' . $id . '';
    </script>";
    //exit;
}

?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Clientes</title>
</head>

<body>
    <div class="container"><br>
        <div class="row">
            <div class="col-4">
                <div class="row justify-content-center">
                    <h4>Editar Cliente</h4>
                    <hr>
                    <form class="mx-auto" method="post">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $cliente['nombre'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="raza" class="form-label">Telefono:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $cliente['telefono'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">DUI:</label>
                            <input type="text" class="form-control" id="dui" name="dui" value="<?php echo $cliente['dui'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Direccion:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $cliente['direccion'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="altura" class="form-label">Email:</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $cliente['email'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status:</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                       
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>


                </div>
            </div>
            <div class="col-8">

            </div>
        </div>


        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>