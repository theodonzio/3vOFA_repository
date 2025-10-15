<?php
include '../php/login/conexion_bd.php'; // ajusta si es necesario

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = ucfirst(strtolower(trim($_POST['nombre'])));
    $apellido = ucfirst(strtolower(trim($_POST['apellido'])));
    $cedula = trim($_POST['cedula']);
    $email = trim($_POST['email']);
    $contrasena = $_POST['contrasena'];
    $id_rol = 1; // rol 1 = adscripta

    // Validaciones básicas
    if (!preg_match('/^[0-9]{8}$/', $cedula) || 
        !preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/', $contrasena)) {
        header("Location: registrar_adscripta.php?registro=error");
        exit;
    }

    // Verificar si ya existe email o cédula
    $check = $conn->prepare("SELECT * FROM usuario WHERE email = ? OR cedula = ?");
    $check->bind_param("ss", $email, $cedula);
    $check->execute();
    $result = $check->get_result();
    if ($result->num_rows > 0) {
        header("Location: registrar_adscripta.php?registro=duplicado");
        exit;
    }

    // Encriptar contraseña
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);

    // Insertar en BD
    $sql = "INSERT INTO usuario (nombre, apellido, cedula, email, contrasena, id_rol)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nombre, $apellido, $cedula, $email, $hash, $id_rol);

    if ($stmt->execute()) {
        header("Location: registrar_adscripta.php?registro=success");
    } else {
        header("Location: registrar_adscripta.php?registro=error");
    }

    $stmt->close();
    $conn->close();
}
?>