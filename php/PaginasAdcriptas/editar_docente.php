<?php
session_start();
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../../index.php?login=required");
    exit;
}

include '../login/conexion_bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_usuario'])) {
    $id = intval($_POST['id_usuario']);
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
    $cedula = isset($_POST['cedula']) ? preg_replace('/\D+/', '', trim($_POST['cedula'])) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    // Validación básica
    if ($nombre === '' || $apellido === '' || $cedula === '' || $email === '') {
        header("Location: docentes.php?edit=error");
        exit;
    }

    // --- Validar formato numérico de cédula (8 dígitos) ---
    if (!preg_match('/^\d{8}$/', $cedula)) {
        header("Location: docentes.php?edit=cedula_invalida");
        exit;
    }

    // --- Validar dígito verificador de la cédula ---
    $factores = [2, 9, 8, 7, 6, 3, 4];
    $suma = 0;
    for ($i = 0; $i < 7; $i++) {
        $suma += $cedula[$i] * $factores[$i];
    }
    $dv = (10 - ($suma % 10)) % 10;

    if ($cedula[7] != $dv) {
        header("Location: docentes.php?edit=cedula_dv_invalido");
        exit;
    }

    // --- Verificar duplicados (cédula o email) excluyendo el usuario actual ---
    $check = $conn->prepare("SELECT id_usuario FROM usuario WHERE (cedula = ? OR email = ?) AND id_usuario != ?");
    $check->bind_param("ssi", $cedula, $email, $id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        // Ya existe otro usuario con la misma cédula o email
        $check->close();
        $conn->close();
        header("Location: docentes.php?edit=duplicado");
        exit;
    }
    $check->close();

    // Actualizar docente
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