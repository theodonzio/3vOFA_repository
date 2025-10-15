<?php
header('Content-Type: application/json');
include_once '../login/conexion_bd.php';

if (!isset($_GET['id_grupo'])) {
    echo json_encode([]);
    exit;
}

$id_grupo = intval($_GET['id_grupo']);

// Buscar el curso del grupo
$sql = "SELECT id_curso FROM grupo WHERE id_grupo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_grupo);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();

if (!$row) {
    echo json_encode([]);
    exit;
}

$id_curso = intval($row['id_curso']);

// Obtener horarios permitidos del curso
$sql2 = "SELECT id_horario FROM curso_horario WHERE id_curso = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $id_curso);
$stmt2->execute();
$res2 = $stmt2->get_result();

$horarios = [];
while ($h = $res2->fetch_assoc()) {
    $horarios[] = $h;
}

echo json_encode($horarios);
?>
