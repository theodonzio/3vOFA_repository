<?php
session_start();
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../../index.php?login=required");
    exit;
}

include '../login/conexion_bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_curso'])) {
    $id = $_POST['id_curso'];
    $nombre = isset($_POST['nombre_curso']) ? trim($_POST['nombre_curso']) : '';
    $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : null;
    $duracion = isset($_POST['duracion_anos']) && $_POST['duracion_anos'] !== '' ? intval($_POST['duracion_anos']) : null;

    // Validaciones mínimas
    if ($nombre === '') {
        header("Location: cursos.php?edit=error");
        exit;
    }

    $sql = "UPDATE curso SET nombre_curso = ?, descripcion = ?, duracion_anos = ? WHERE id_curso = ?";
    if ($stmt = $conn->prepare($sql)) {
        // si $descripcion o $duracion son null, los seteamos como null (bind_param no acepta null directo, usar tipo s y syscall)
        // Para manejar nulls, convertimos a tipos y usamos bind_param con valores
        $stmt->bind_param("ssii",
            $nombre,
            $descripcion,
            $duracion,
            $id
        );
        // Si $descripcion o $duracion pueden ser null, necesitamos ajustar.
        // Pero bind_param no admite null para integer si variable es null en ciertas versiones. Por simplicidad convertimos null a 0 si es null en integer; descripción si null pasa como empty string.
        // Ajuste: asegurar que variables no sean null para bind:
        if ($descripcion === null) $descripcion = '';
        if ($duracion === null) $duracion = 0;

        $stmt->bind_param("ssii", $nombre, $descripcion, $duracion, $id);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: cursos.php?edit=success");
            exit;
        } else {
            $stmt->close();
            $conn->close();
            header("Location: cursos.php?edit=error");
            exit;
        }
    } else {
        $conn->close();
        header("Location: cursos.php?edit=error");
        exit;
    }
}

header("Location: cursos.php");
exit;
