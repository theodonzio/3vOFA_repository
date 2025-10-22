<?php
session_start();
include '../login/conexion_bd.php';

// Verificar que sea un docente
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 2) {
    header("Location: ../index.php?login=unauthorized");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_docente = $_SESSION['id_usuario'];
    $fecha_inasistencia = trim($_POST['fecha_inasistencia']);
    $motivo = trim($_POST['motivo']);

    // Validar que la fecha no sea pasada
    $fecha_actual = date('Y-m-d');
    if ($fecha_inasistencia < $fecha_actual) {
        header("Location: ../usuarios/docente.php?inasistencia=fecha_pasada");
        exit;
    }

    // Verificar si ya existe un aviso para esa fecha
    $check = $conn->prepare("SELECT id_aviso FROM aviso_inasistencia WHERE id_docente = ? AND fecha_inasistencia = ?");
    $check->bind_param("is", $id_docente, $fecha_inasistencia);
    $check->execute();
    $result = $check->get_result();
    
    if ($result->num_rows > 0) {
        header("Location: ../usuarios/docente.php?inasistencia=duplicado");
        exit;
    }
    $check->close();

    // Insertar el aviso
    $sql = "INSERT INTO aviso_inasistencia (id_docente, fecha_inasistencia, motivo) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $id_docente, $fecha_inasistencia, $motivo);

    if ($stmt->execute()) {
        header("Location: ../usuarios/docente.php?inasistencia=success");
        exit;
    } else {
        header("Location: ../usuarios/docente.php?inasistencia=error");
        exit;
    }

    $stmt->close();
}

$conn->close();
?>