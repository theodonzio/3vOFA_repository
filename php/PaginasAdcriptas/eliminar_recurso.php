<?php
session_start();
include '../login/conexion_bd.php';

// Verifica sesión (solo adscripta - rol 1)
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../../index.php?login=" . (!isset($_SESSION['id_usuario']) ? 'required' : 'unauthorized'));
    exit;
}

// Verifica que se haya pasado un ID válido
if (isset($_GET['id'])) {
    $id_recurso = intval($_GET['id']);

    // Prepara y ejecuta la eliminación
    $sql = "DELETE FROM recurso WHERE id_recurso = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_recurso);

    if ($stmt->execute()) {
        header("Location: recursos.php?delete=success");
    } else {
        echo "Error al eliminar el recurso: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "ID de recurso no especificado.";
}

$conn->close();
?>
