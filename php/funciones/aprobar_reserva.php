<?php
include '../login/conexion_bd.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos
    $id_reserva = intval($_POST['id_reserva']);
    $accion = isset($_POST['accion']) ? $_POST['accion'] : '';

    // Determinar el estado según la acción
    if ($accion == 'Aprobar') {
        $nuevo_estado = 'Aprobada';
        $mensaje = 'Reserva aprobada correctamente';
    } elseif ($accion == 'Rechazar') {
        $nuevo_estado = 'No aprobada';
        $mensaje = 'Reserva rechazada correctamente';
    } else {
        echo "<script>alert('Error: Acción no reconocida'); window.location='../usuarios/adscripta.php';</script>";
        exit;
    }

    // Actualizar en la base de datos
    $sql = "UPDATE reserva SET estado = ? WHERE id_reserva = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nuevo_estado, $id_reserva);

    if ($stmt->execute()) {
        echo "<script>alert('" . $mensaje . "'); window.location='../usuarios/adscripta.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar la reserva'); window.location='../usuarios/adscripta.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../usuarios/adscripta.php");
    exit;
}
?>