<?php
  include '../tools/head.php';
  include '../tools/header_adscripta.php';
include '../login/conexion_bd.php';

// Obtener todos los docentes (id_rol = 2)
$sql = "SELECT id_usuario, nombre, apellido, cedula, email FROM Usuario WHERE id_rol = 2";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Docentes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container py-5">
  <h1 class="text-center mb-4">Lista de Docentes Registrados</h1>

  <div class="text-center mb-3">
    <a href="../usuarios/adscripta.php" class="btn btn-outline-light">⬅ Volver</a>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-dark table-hover align-middle">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Cédula</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id_usuario']}</td>
                    <td>{$row['nombre']}</td>
                    <td>{$row['apellido']}</td>
                    <td>{$row['cedula']}</td>
                    <td>{$row['email']}</td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='5' class='text-center'>No hay docentes registrados</td></tr>";
        }

        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
