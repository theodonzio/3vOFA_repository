<?php
include '../login/conexion_bd.php';

$id = $_POST['id_horario'];
$nombre = $_POST['nombre_horario'];
$inicio = $_POST['hora_inicio'];
$fin = $_POST['hora_fin'];

$sql = "UPDATE horario 
        SET nombre_horario = '$nombre', hora_inicio = '$inicio', hora_fin = '$fin' 
        WHERE id_horario = $id";
$conn->query($sql);

header('Location: ../usuarios/adscripta.php');
exit();
?>
