<?php
// agregar_grupo.php
include '../login/conexion_bd.php';

// Verificar que los datos llegaron por POST
if (isset($_POST['nombre_grupo'], $_POST['anio_curso'], $_POST['id_curso'], $_POST['id_turno'])) {
    $nombre_grupo = $conn->real_escape_string($_POST['nombre_grupo']);
    $anio_curso = (int) $_POST['anio_curso'];
    $id_curso = (int) $_POST['id_curso'];
    $id_turno = (int) $_POST['id_turno'];

    // Insertar en la base de datos
    $sql = "INSERT INTO grupo (nombre_grupo, anio_curso, id_curso, id_turno) 
            VALUES ('$nombre_grupo', $anio_curso, $id_curso, $id_turno)";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Grupo agregado correctamente";
        $tipo = "success";
    } else {
        $mensaje = "Error al agregar el grupo: " . $conn->error;
        $tipo = "error";
    }
} else {
    $mensaje = "Faltan datos obligatorios";
    $tipo = "error";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Grupo</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
    Swal.fire({
        icon: '<?php echo $tipo; ?>',
        title: '<?php echo $mensaje; ?>',
        confirmButtonText: 'Aceptar'
    }).then(() => {
        // Redirige de vuelta a la página de administración
        window.location.href = '../usuarios/adscripta.php';
    });
</script>
</body>
</html>
