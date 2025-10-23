<?php
session_start();
include '../login/conexion_bd.php';

// Verificar sesión (solo adscripta - rol 1)
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../../index.php?login=" . (!isset($_SESSION['id_usuario']) ? 'required' : 'unauthorized'));
    exit;
}

// Verificar que los datos se hayan enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_recurso = $_POST['id_recurso'];
    $nombre_recurso = trim($_POST['nombre_recurso']);
    $tipo = trim($_POST['tipo']);
    $estado = trim($_POST['estado']);
    $id_espacio = $_POST['id_espacio'];

    // Preparar y ejecutar la actualización
    $sql = "UPDATE recurso 
            SET nombre_recurso = ?, tipo = ?, estado = ?, id_espacio = ?
            WHERE id_recurso = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $nombre_recurso, $tipo, $estado, $id_espacio, $id_recurso);

    if ($stmt->execute()) {
        header("Location: recursos.php?edit=success");
    } else {
        echo "Error al actualizar el recurso: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
