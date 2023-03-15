<!doctype html>
<html lang="en">
<?php include('menu.php'); ?>
<?php include('config.php'); ?>
<?php
$id = $_GET['id'];
// Obtener los datos actuales del registro
$stmt = $pdo->prepare("SELECT * FROM mascotas WHERE id_mascota = :id");
$stmt->execute(['id' => $id]);
$mascota = $stmt->fetch(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $raza = $_POST['raza'];
    $color = $_POST['color'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $sexo = $_POST['sexo'];
    $fech_nacimiento = $_POST['fech_nacimiento'];

    // Actualizar el registro en la base de datos
    $stmt = $pdo->prepare("UPDATE mascotas SET nombre = :nombre, 
                                                raza = :raza, 
                                                color = :color, 
                                                peso = :peso, 
                                                altura = :altura, 
                                                sexo = :sexo, 
                                                fech_nacimiento = :fech_nacimiento 
                                                WHERE id_mascota = :id");
    $stmt->execute([
        'nombre' => $nombre,
        'raza' => $raza,
        'color' => $color,
        'peso' => $peso,
        'altura' => $altura,
        'sexo' => $sexo,
        'fech_nacimiento' => $fech_nacimiento,
        'id' => $id
    ]);

    // Redirigir de vuelta a la lista de registros
    echo "<script>alert('La mascota actualizada correctamente'); 
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

    <title>Mascotas</title>
</head>

<body>
    <div class="container"><br>
        <div class="row">
            <div class="col-4">
                <div class="row justify-content-center">
                    <h4>Editar Mascota</h4>
                    <hr>
                    <form class="mx-auto" method="post">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $mascota['nombre'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="raza" class="form-label">Raza:</label>
                            <input type="text" class="form-control" id="raza" name="raza" value="<?php echo $mascota['raza'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Color:</label>
                            <input type="text" class="form-control" id="color" name="color" value="<?php echo $mascota['color'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="peso" class="form-label">Peso:</label>
                            <input type="number" class="form-control" id="peso" name="peso" step="0.01" value="<?php echo $mascota['peso'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="altura" class="form-label">Altura:</label>
                            <input type="number" class="form-control" id="altura" name="altura" step="0.01" value="<?php echo $mascota['altura'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="sexo" class="form-label">Sexo:</label>
                            <select class="form-select" id="sexo" name="sexo">
                                <option value="m">Macho</option>
                                <option value="h">Hembra</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fech_nacimiento" class="form-label">Fecha de nacimiento:</label>
                            <input type="date" class="form-control" id="fech_nacimiento" name="fech_nacimiento" value="<?php echo $mascota['fech_nacimiento'] ?>">
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