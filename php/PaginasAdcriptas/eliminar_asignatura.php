<?php
session_start();
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../../index.php?login=required");
    exit;
}

include '../login/conexion_bd.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar asignatura con prepared statement
    $sql = "DELETE FROM asignatura WHERE id_asignatura = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: asignaturas.php?delete=success");
            exit;
        } else {
            $stmt->close();
            $conn->close();
            header("Location: asignaturas.php?delete=error");
            exit;
        }
    } else {
        $conn->close();
        header("Location: asignaturas.php?delete=error");
        exit;
    }
}

header("Location: asignaturas.php");
exit;
?>
