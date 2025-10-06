<?php
include '../login/conexion_bd.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_reserva = $_POST['id_reserva'];
    $accion = $_POST['accion']; // "Aprobar" o "Rechazar"

    if($accion == 'Aprobar'){
        // Cambiar estado a Aprobada
        $nuevo_estado = 'Aprobada';
        $sql = "UPDATE reserva SET estado = ? WHERE id_reserva = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $nuevo_estado, $id_reserva);
        $mensaje = "Reserva aprobada con éxito";
    } else {
        // Rechazar = eliminar la reserva
        $sql = "DELETE FROM reserva WHERE id_reserva = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_reserva);
        $mensaje = "Reserva rechazada y eliminada";
    }

    if($stmt->execute()){
        echo "<script>alert('$mensaje'); window.location='../usuarios/adscripta.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>