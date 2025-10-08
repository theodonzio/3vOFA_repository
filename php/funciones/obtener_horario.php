<?php
include '../conexion.php';

$id_grupo = $_GET['id_grupo'] ?? null;
if (!$id_grupo) exit(json_encode([]));

$sql = "SELECT * FROM grupo_horario WHERE id_grupo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_grupo);
$stmt->execute();
$result = $stmt->get_result();

$datos = [];
while ($row = $result->fetch_assoc()) {
  $datos[] = $row;
}

echo json_encode($datos);
