<?php
/**
 * Obtener asignaturas de un grupo específico
 */
header('Content-Type: application/json');
include_once '../login/conexion_bd.php';

if (!isset($_GET['id_grupo'])) {
    echo json_encode([]);
    exit;
}

$id_grupo = intval($_GET['id_grupo']);

try {
    // Obtener las asignaturas asignadas a este grupo
    $sql = "SELECT DISTINCT a.id_asignatura, a.nombre_asignatura 
            FROM grupo_asignatura ga
            JOIN asignatura a ON ga.id_asignatura = a.id_asignatura
            WHERE ga.id_grupo = ?
            ORDER BY a.nombre_asignatura";

    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        throw new Exception("Error al preparar consulta: " . $conn->error);
    }
    
    $stmt->bind_param("i", $id_grupo);
    $stmt->execute();
    $result = $stmt->get_result();

    $asignaturas = [];
    while ($row = $result->fetch_assoc()) {
        $asignaturas[] = [
            'id_asignatura' => intval($row['id_asignatura']),
            'nombre_asignatura' => $row['nombre_asignatura']
        ];
    }

    echo json_encode($asignaturas);
    $stmt->close();
    
} catch (Exception $e) {
    // En caso de error, devolver array vacío
    echo json_encode([]);
}

$conn->close();