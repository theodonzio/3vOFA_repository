<?php
/**
 * Obtener horarios permitidos para un grupo según su curso
 */
header('Content-Type: application/json');
include_once '../login/conexion_bd.php';

if (!isset($_GET['id_grupo'])) {
    echo json_encode([]);
    exit;
}

$id_grupo = intval($_GET['id_grupo']);

try {
    // Obtener el ID del curso del grupo
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

    // Obtener los horarios permitidos para ese curso
    $sql2 = "SELECT id_horario FROM curso_horario WHERE id_curso = ? ORDER BY id_horario";
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
            'id_horario' => intval($h['id_horario'])
        ];
    }

    echo json_encode($horarios);
    $stmt2->close();
    
} catch (Exception $e) {
    // En caso de error, devolver array vacío
    echo json_encode([]);
}

$conn->close();