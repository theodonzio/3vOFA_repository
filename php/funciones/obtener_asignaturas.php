<?php
include '../conexion.php';

$id_grupo = $_GET['id_grupo'] ?? null;
if (!$id_grupo) {
  echo json_encode([]);
  exit;
}

$sql = "SELECT a.id_asignatura, a.nombre_asignatura 
        FROM grupo_asignatura ga
        JOIN asignatura a ON ga.id_asignatura = a.id_asignatura
        WHERE ga.id_grupo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_grupo);
$stmt->execute();
$result = $stmt->get_result();

$asignaturas = [];
while ($row = $result->fetch_assoc()) {
  $asignaturas[] = $row;
}

echo json_encode($asignaturas);
