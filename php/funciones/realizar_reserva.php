<?php
include '../login/conexion_bd.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_docente = $_SESSION['id_usuario']; // docente logueado
    $id_espacio = $_POST['id_espacio'];
    $fecha_reserva = $_POST['fecha_reserva'];
    $id_horario = $_POST['id_horario'];

    // Obtener horas de la tabla horario
    $sql_h = "SELECT hora_inicio, hora_fin FROM horario WHERE id_horario = ?";
    $stmt_h = $conn->prepare($sql_h);
    $stmt_h->bind_param("i", $id_horario);
    $stmt_h->execute();
    $result_h = $stmt_h->get_result();
    $row_h = $result_h->fetch_assoc();
    $hora_inicio = $row_h['hora_inicio'];
    $hora_fin = $row_h['hora_fin'];
    $stmt_h->close();

    $fecha_inicio = $fecha_reserva . ' ' . $hora_inicio;
    $fecha_fin = $fecha_reserva . ' ' . $hora_fin;

    // Guardar reserva
    $sql = "INSERT INTO reserva (fecha_inicio, fecha_fin, tipo_reserva, estado, id_docente, id_espacio)
            VALUES (?, ?, 'Clase', 'Pendiente', ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $fecha_inicio, $fecha_fin, $id_docente, $id_espacio);

    if ($stmt->execute()) {
        echo "<script>alert('Reserva realizada con éxito'); window.location='../usuarios/docente.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>