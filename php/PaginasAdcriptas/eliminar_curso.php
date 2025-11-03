<?php
session_start();
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../../index.php?login=required");
    exit;
}

include '../login/conexion_bd.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Limpia id 
    $sql = "DELETE FROM curso WHERE id_curso = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: cursos.php?delete=success");
            exit;
        } else {
            $stmt->close();
            $conn->close();
            header("Location: cursos.php?delete=error");
            exit;
        }
    } else {
        $conn->close();
        header("Location: cursos.php?delete=error");
        exit;
    }
}

header("Location: cursos.php");
exit;
