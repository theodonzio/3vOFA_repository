<?php
/**
 * Obtiene horarios guardados de un grupo específico
 */

header('Content-Type: application/json');
include_once '../login/conexion_bd.php';

if (!isset($_GET['id_grupo'])) {
    echo json_encode([]);
    exit;
}

$id_grupo = intval($_GET['id_grupo']);

try {
    $sql = "SELECT id_horario, dia_semana, id_asignatura
            FROM horario_grupo_asignatura
            WHERE id_grupo = ?
            ORDER BY id_horario, dia_semana";
    
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        throw new Exception("Error al preparar consulta: " . $conn->error);
    }
    
    $stmt->bind_param("i", $id_grupo);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $horarios = [];
    while ($row = $result->fetch_assoc()) {
        $horarios[] = [
            'id_horario' => intval($row['id_horario']),
            'dia_semana' => intval($row['dia_semana']),
            'id_asignatura' => $row['id_asignatura'] ? intval($row['id_asignatura']) : null
        ];
    }
    
    echo json_encode($horarios);
    $stmt->close();
    
} catch (Exception $e) {
    error_log("Error en obtener_horario.php: " . $e->getMessage());
    echo json_encode([]);
}

$conn->close();