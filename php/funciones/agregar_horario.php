<?php
include '../login/conexion_bd.php';

$nombre = $_POST['nombre_horario'];
$inicio = $_POST['hora_inicio'];
$fin = $_POST['hora_fin'];

$sql = "INSERT INTO horario (nombre_horario, hora_inicio, hora_fin) VALUES ('$nombre', '$inicio', '$fin')";

if ($conn->query($sql) === TRUE) {
    header('Location: ../usuarios/adscripta.php?success=horario');
    exit();
} else {
    header('Location: ../usuarios/adscripta.php?error=horario');
    exit();
}
?>