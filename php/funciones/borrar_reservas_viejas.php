<?php
include '../login/conexion_bd.php';

// Borra reservas cuya fecha_inicio fue hace más de 1 día
$sql = "DELETE FROM reserva 
        WHERE fecha_inicio < NOW() - INTERVAL 1 DAY 
        AND estado IN ('Rechazada', 'No aprobada', 'Rechazado')";
        
if ($conn->query($sql) === TRUE) {
}
$conn->close();
?>
