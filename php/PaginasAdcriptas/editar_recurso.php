<?php
session_start();
include '../login/conexion_bd.php';

// Verifica sesión (solo adscripta - rol 1)
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../../index.php?login=" . (!isset($_SESSION['id_usuario']) ? 'required' : 'unauthorized'));
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_recurso = intval($_POST['id_recurso']);
    $nombre_recurso = trim($_POST['nombre_recurso']);
    $tipo = trim($_POST['tipo']);

    if (!empty($nombre_recurso)) {
        // Verifica si el nombre ya existe en otro recurso
        $check_sql = "SELECT COUNT(*) FROM recurso WHERE nombre_recurso = ? AND id_recurso != ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("si", $nombre_recurso, $id_recurso);
        $check_stmt->execute();
        $check_stmt->bind_result($count);
        $check_stmt->fetch();
        $check_stmt->close();

        if ($count > 0) {
            header("Location: recursos.php?edit=duplicate");
            exit;
        }

        // Actualiza
        $sql = "UPDATE recurso SET nombre_recurso = ?, tipo = ? WHERE id_recurso = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $nombre_recurso, $tipo, $id_recurso);

        if ($stmt->execute()) {
            header("Location: recursos.php?edit=success");
            exit;
        } else {
            echo "Error al editar el recurso: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "El campo 'nombre_recurso' es obligatorio.";
    }
}

$conn->close();
?>
