<?php
include '../login/conexion_bd.php';

$id = $_GET['id'];

$sql = "DELETE FROM horario WHERE id_horario = $id";
$conn->query($sql);

header('Location: ../usuarios/adscripta.php');
exit();
?>
