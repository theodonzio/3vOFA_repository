<?php
include '../login/conexion_bd.php'; // conexión BD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // --- Sanitiza y normaliza entradas ---
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $cedula = preg_replace('/\D+/', '', $_POST['cedula']); // elimina puntos o guiones
    $email = trim($_POST['email']);
    $contrasena = $_POST['contrasena'];
    $id_rol = $_POST['id_rol']; // siempre 2 (docente)

    // --- Normaliza nombres ---
    $nombre = ucfirst(strtolower($nombre));
    $apellido = ucfirst(strtolower($apellido));

    // --- Valida formato numérico de cédula ---
    if (!preg_match('/^\d{8}$/', $cedula)) {
        header("Location: ../usuarios/adscripta.php?docente=cedula_invalida");
        exit;
    }

    // --- Valida dígito verificador de la cédula ---
    $factores = [2, 9, 8, 7, 6, 3, 4];
    $suma = 0;
    for ($i = 0; $i < 7; $i++) {
        $suma += $cedula[$i] * $factores[$i];
    }
    $dv = (10 - ($suma % 10)) % 10;

    if ($cedula[7] != $dv) {
        header("Location: ../usuarios/adscripta.php?docente=cedula_dv_invalido");
        exit;
    }

    // --- Valida contraseña (mínimo 6, letras y números) ---
    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d!@#$%^&*()_+=-]{6,}$/', $contrasena)) {
        header("Location: ../usuarios/adscripta.php?docente=contrasena_invalida");
        exit;
    }

    // --- Verifica duplicados (cédula o email) ---
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

    // --- Hashea y guarda ---
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