<?php
session_start();
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../../index.php?login=required");
    exit;
}

include '../login/conexion_bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_grupo'])) {
    $id = intval($_POST['id_grupo']);
    $nombre = isset($_POST['nombre_grupo']) ? trim($_POST['nombre_grupo']) : '';
    $anio = isset($_POST['anio_curso']) && $_POST['anio_curso'] !== '' ? intval($_POST['anio_curso']) : null;
    $id_curso = isset($_POST['id_curso']) && $_POST['id_curso'] !== '' ? intval($_POST['id_curso']) : null;
    $id_turno = isset($_POST['id_turno']) && $_POST['id_turno'] !== '' ? intval($_POST['id_turno']) : null;

    // Validación mínima
    if ($nombre === '') {
        header("Location: grupos.php?edit=error");
        exit;
    }

    $sql = "UPDATE grupo SET nombre_grupo = ?, anio_curso = ?, id_curso = ?, id_turno = ? WHERE id_grupo = ?";
    if ($stmt = $conn->prepare($sql)) {
        // bind_param requiere valores: usar 1/0 o NULL según convenga. Aquí convertimos nulls a NULL mediante sentencia (bind with i and use null ints as null)
        // MySQLi bind_param doesn't accept PHP null for integer in some setups; simplest: set to 0 if null (or keep null using s and SQL NULL handling).
        // Vamos a permitir 0 para curso/turno cuando no se selecciona (ajusta según tu modelo si prefieres permitir NULL).
        $bind_id_curso = $id_curso ?? 0;
        $bind_id_turno = $id_turno ?? 0;
        $bind_anio = $anio ?? 0;

        $stmt->bind_param("siiii", $nombre, $bind_anio, $bind_id_curso, $bind_id_turno, $id);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: grupos.php?edit=success");
            exit;
        } else {
            $stmt->close();
            $conn->close();
            header("Location: grupos.php?edit=error");
            exit;
        }
    } else {
        $conn->close();
        header("Location: grupos.php?edit=error");
        exit;
    }
}

header("Location: grupos.php");
exit;
?>
