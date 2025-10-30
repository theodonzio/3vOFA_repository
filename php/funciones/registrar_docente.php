<?php
include '../login/conexion_bd.php'; // conexión BD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // --- Sanitizar y normalizar entradas ---
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $cedula = trim($_POST['cedula']);
    $email = trim($_POST['email']);
    $contrasena = $_POST['contrasena'];
    $id_rol = $_POST['id_rol']; // siempre 2 (docente)

    // --- Validaciones ---
    $nombre = ucfirst(strtolower($nombre));
    $apellido = ucfirst(strtolower($apellido));

    // Validar formato de cédula
    if (!preg_match('/^\d{8}$/', $cedula)) {
        header("Location: ../usuarios/adscripta.php?docente=cedula_invalida");
        exit;
    }

    // Validar contraseña
    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d!@#$%^&*()_+=-]{6,}$/', $contrasena)) {
        header("Location: ../usuarios/adscripta.php?docente=contrasena_invalida");
        exit;
    }

    // --- Verificar duplicados (cedula o email) ---
    $check = $conn->prepare("SELECT id_usuario FROM usuario WHERE cedula = ? OR email = ?");
    $check->bind_param("ss", $cedula, $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        // Ya existe un usuario con la misma cédula o email
        $check->close();
        $conn->close();
        header("Location: ../usuarios/adscripta.php?docente=duplicado");
        exit;
    }

    $check->close();

    // --- Hashear y guardar ---
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuario (nombre, apellido, cedula, email, contrasena, id_rol)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nombre, $apellido, $cedula, $email, $contrasena_hash, $id_rol);

    if ($stmt->execute()) {
        header("Location: ../usuarios/adscripta.php?docente=success");
        exit;
    } else {
        header("Location: ../usuarios/adscripta.php?docente=error");
        exit;
    }

    $stmt->close();
    $conn->close();
}
?>