<?php
session_start();
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../../index.php?login=required");
    exit;
}

include '../login/conexion_bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_usuario'])) {
    $id = $_POST['id_usuario'];
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
    $cedula = isset($_POST['cedula']) ? trim($_POST['cedula']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    // Validación básica
    if ($nombre === '' || $apellido === '' || $cedula === '' || $email === '') {
        header("Location: docentes.php?edit=error");
        exit;
    }

    $sql = "UPDATE usuario 
            SET nombre = ?, apellido = ?, cedula = ?, email = ? 
            WHERE id_usuario = ? AND id_rol = 2";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssi", $nombre, $apellido, $cedula, $email, $id);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: docentes.php?edit=success");
            exit;
        } else {
            $stmt->close();
            $conn->close();
            header("Location: docentes.php?edit=error");
            exit;
        }
    } else {
        $conn->close();
        header("Location: docentes.php?edit=error");
        exit;
    }
}

header("Location: docentes.php");
exit;
?>
