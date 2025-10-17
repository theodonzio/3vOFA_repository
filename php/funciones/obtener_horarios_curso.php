<?php
header('Content-Type: application/json');
include_once '../login/conexion_bd.php';

if (!isset($_GET['id_grupo'])) {
    echo json_encode([]);
    exit;
}

$id_grupo = intval($_GET['id_grupo']);

try {
    $sql = "SELECT id_curso FROM grupo WHERE id_grupo = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        throw new Exception("Error al preparar consulta: " . $conn->error);
    }
    
    $stmt->bind_param("i", $id_grupo);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();

    if (!$row) {
        echo json_encode([]);
        exit;
    }

    $id_curso = intval($row['id_curso']);
    $stmt->close();

    $sql2 = "SELECT h.id_horario, h.nombre_horario, h.hora_inicio, h.hora_fin 
             FROM curso_horario ch
             JOIN horario h ON ch.id_horario = h.id_horario
             WHERE ch.id_curso = ? 
             ORDER BY h.hora_inicio";
    
    $stmt2 = $conn->prepare($sql2);
    
    if (!$stmt2) {
        throw new Exception("Error al preparar consulta: " . $conn->error);
    }
    
    $stmt2->bind_param("i", $id_curso);
    $stmt2->execute();
    $res2 = $stmt2->get_result();

    $horarios = [];
    while ($h = $res2->fetch_assoc()) {
        $horarios[] = [
            'id_horario' => intval($h['id_horario']),
            'nombre_horario' => $h['nombre_horario'],
            'hora_inicio' => $h['hora_inicio'],
            'hora_fin' => $h['hora_fin']
        ];
    }

    echo json_encode($horarios);
    $stmt2->close();
    
} catch (Exception $e) {
    error_log("Error en obtener_horarios_curso.php: " . $e->getMessage());
    echo json_encode([]);
}

$conn->close();