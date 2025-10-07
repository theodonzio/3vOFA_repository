<?php
session_start();
include 'conexion_bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $contrasena = trim($_POST['contrasena']);

    $sql = "SELECT * FROM usuario WHERE (email = ? OR cedula = ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($contrasena, $row['contrasena'])) {
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['id_rol'] = $row['id_rol'];

            // Redirigir con login=success y rol
            header("Location: ../index.php?login=success&rol=" . $row['id_rol']);
            exit;
        } else {
            header("Location: ../index.php?login=error_pass");
            exit;
        }
    } else {
        header("Location: ../index.php?login=error_user");
        exit;
    }
}
?>