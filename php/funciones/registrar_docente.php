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
        echo "<script>alert('Docente registrado con éxito'); window.location='../usuarios/adscripta.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
