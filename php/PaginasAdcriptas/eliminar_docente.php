<?php
session_start();
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../../index.php?login=required");
    exit;
}

include '../login/conexion_bd.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM usuario WHERE id_usuario = ? AND id_rol = 2";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: docentes.php?delete=success");
            exit;
        } else {
            $stmt->close();
            $conn->close();
            header("Location: docentes.php?delete=error");
            exit;
        }
    } else {
        $conn->close();
        header("Location: docentes.php?delete=error");
        exit;
    }
}

header("Location: docentes.php");
exit;
?>
