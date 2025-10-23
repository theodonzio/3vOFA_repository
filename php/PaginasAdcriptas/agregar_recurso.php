<?php
session_start();
include '../login/conexion_bd.php';

// Verificar sesión (solo adscripta - rol 1)
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../../index.php?login=" . (!isset($_SESSION['id_usuario']) ? 'required' : 'unauthorized'));
    exit;
}

// Si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre_recurso = trim($_POST['nombre_recurso']);
    $tipo = trim($_POST['tipo']);

    // Validar campos requeridos
    if (!empty($nombre_recurso)) {
        // Insertar el nuevo recurso
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
