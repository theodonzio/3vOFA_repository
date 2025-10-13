<?php
include '../login/conexion_bd.php'; // tu archivo de conexión a la BD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar y normalizar entradas
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $cedula = trim($_POST['cedula']);
    $email = trim($_POST['email']);
    $contrasena = $_POST['contrasena'];
    $id_rol = $_POST['id_rol']; // siempre 2 (docente)

    // --- VALIDACIONES ---

    // 1️⃣ Nombre y apellido: primera letra mayúscula, resto minúscula
    $nombre = ucfirst(strtolower($nombre));
    $apellido = ucfirst(strtolower($apellido));

    // 2️⃣ Cédula: debe tener exactamente 8 dígitos numéricos
    if (!preg_match('/^\d{8}$/', $cedula)) {
        header("Location: ../usuarios/adscripta.php?docente=cedula_invalida");
        exit;
    }

    // 3️⃣ Contraseña: al menos una letra y un número, mínimo 6 caracteres
    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/', $contrasena)) {
        header("Location: ../usuarios/adscripta.php?docente=contrasena_invalida");
        exit;
    }

    // 4️⃣ Hashear contraseña solo después de validar
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

    // --- Inserción en la base de datos ---
    $sql = "INSERT INTO Usuario (nombre, apellido, cedula, email, contrasena, id_rol)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nombre, $apellido, $cedula, $email, $contrasena_hash, $id_rol);

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