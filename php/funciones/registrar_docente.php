<?php
include '../login/conexion_bd.php'; // tu archivo de conexión a la BD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cedula = $_POST['cedula'];
    $email = $_POST['email'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    $id_rol = $_POST['id_rol']; // siempre 2 (docente)

    $sql = "INSERT INTO Usuario (nombre, apellido, cedula, email, contrasena, id_rol)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nombre, $apellido, $cedula, $email, $contrasena, $id_rol);

if ($stmt->execute()) {
    header("Location: ../usuarios/adscripta.php?docente=success");
    exit;
} else {
    header("Location: ../usuarios/adscripta.php?docente=error");
}

    $stmt->close();
    $conn->close();
}
?>
