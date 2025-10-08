<?php
header('Content-Type: application/json');
include_once '../login/conexion_bd.php';

if (!isset($_GET['id_grupo'])) {
    echo json_encode([]);
    exit;
}

$id_grupo = intval($_GET['id_grupo']);

// Traemos los horarios guardados para este grupo
$sql = "SELECT hga.id_horario, hga.dia_semana, hga.id_asignatura 
        FROM horario_grupo_asignatura hga
        WHERE hga.id_grupo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_grupo);
$stmt->execute();
$result = $stmt->get_result();

$horarios = [];
while ($row = $result->fetch_assoc()) {
    $horarios[] = $row;
}

echo json_encode($horarios);
