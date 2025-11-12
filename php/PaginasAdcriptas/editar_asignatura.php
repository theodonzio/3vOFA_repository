<?php
session_start();

// Verifica sesión
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../../index.php?login=" . (!isset($_SESSION['id_usuario']) ? 'required' : 'unauthorized'));
    exit;
}

include '../login/conexion_bd.php';

// Procesa el formulario si se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $id_asignatura = intval($_GET['id']);
    $nombre_asignatura = trim($_POST['nombre_asignatura']);

    // Actualiza solo el nombre de la asignatura
    $updateAsignatura = $conn->prepare("UPDATE asignatura SET nombre_asignatura = ? WHERE id_asignatura = ?");
    $updateAsignatura->bind_param("si", $nombre_asignatura, $id_asignatura);
    
    if ($updateAsignatura->execute()) {
        header("Location: asignaturas.php?edit=success");
    } else {
        header("Location: asignaturas.php?edit=error");
    }
    exit;
}
header("Location: asignaturas.php");
exit;
?>