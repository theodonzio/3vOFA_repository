<?php
session_start();
include '../login/conexion_bd.php';

// Verifica sesión (solo adscripta - rol 1)
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../../index.php?login=" . (!isset($_SESSION['id_usuario']) ? 'required' : 'unauthorized'));
    exit;
}

// Si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre_recurso = trim($_POST['nombre_recurso']);
    $tipo = trim($_POST['tipo']);

    if (!empty($nombre_recurso)) {
        // Verifica duplicado
        $check_sql = "SELECT COUNT(*) FROM recurso WHERE nombre_recurso = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $nombre_recurso);
        $check_stmt->execute();
        $check_stmt->bind_result($count);
        $check_stmt->fetch();
        $check_stmt->close();

        if ($count > 0) {
            header("Location: ../usuarios/adscripta.php?add=duplicate");
            exit;
        }

        // Inserta nuevo recurso
        $sql = "INSERT INTO recurso (nombre_recurso, tipo) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nombre_recurso, $tipo);

        if ($stmt->execute()) {
            header("Location: ../usuarios/adscripta.php?add=success");
            exit;
        } else {
            echo "Error al agregar el recurso: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "El campo 'nombre_recurso' es obligatorio.";
    }
}

$conn->close();
?>
