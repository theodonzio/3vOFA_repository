<?php
header('Content-Type: application/json');
include_once '../login/conexion_bd.php';

if (!isset($_GET['id_grupo'])) {
    echo json_encode([]);
    exit;
}

$id_grupo = intval($_GET['id_grupo']);

// Traer los horarios guardados para este grupo
$sql = "SELECT id_horario, dia_semana, id_asignatura 
        FROM horario_grupo_asignatura
        WHERE id_grupo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_grupo);
$stmt->execute();
$result = $stmt->get_result();

$horarios = [];
while ($row = $result->fetch_assoc()) {
    $horarios[] = [
        'id_horario' => $row['id_horario'],
        'dia_semana' => $row['dia_semana'],
        'id_asignatura' => $row['id_asignatura']
    ];
}

echo json_encode($horarios);
$stmt->close();
$conn->close();
?>