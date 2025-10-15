<?php
include '../login/conexion_bd.php';

$nombre = $_POST['nombre_horario'];
$inicio = $_POST['hora_inicio'];
$fin = $_POST['hora_fin'];

$sql = "INSERT INTO horario (nombre_horario, hora_inicio, hora_fin) VALUES ('$nombre', '$inicio', '$fin')";
$conn->query($sql);

header('Location: ../usuarios/adscripta.php');
exit();
?>
