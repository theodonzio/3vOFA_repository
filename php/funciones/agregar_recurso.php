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

    // Valida campos requeridos
    if (!empty($nombre_recurso) && !empty($tipo)) {
        // Inserta el nuevo recurso sin id_espacio (será NULL)
        $sql = "INSERT INTO recurso (nombre_recurso, tipo, estado) VALUES (?, ?, 'Disponible')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nombre_recurso, $tipo);

        if ($stmt->execute()) {
            header("Location: ../usuarios/adscripta.php?recurso=success");
            exit;
        } else {
            echo "Error al agregar el recurso: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Los campos 'nombre_recurso' y 'tipo' son obligatorios.";
    }
}

$conn->close();
?>