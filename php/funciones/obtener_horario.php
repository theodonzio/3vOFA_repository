<?php
/**
 * Obtener horarios de un grupo específico para estudiantes
 * Ubicación: php/funciones/obtener_horario_estudiante.php
 */
header('Content-Type: application/json');
include_once '../login/conexion_bd.php';

// Validar parámetro
if (!isset($_GET['id_grupo'])) {
    echo json_encode(['error' => 'No se especificó grupo']);
    exit;
}

$id_grupo = intval($_GET['id_grupo']);

try {
    // Obtener horarios del grupo con sus asignaturas
    $sql = "
        SELECT 
            h.id_horario,
            h.nombre_horario,
            h.hora_inicio,
            h.hora_fin,
            hga.dia_semana,
            a.nombre_asignatura
        FROM horario_grupo_asignatura hga
        JOIN horario h ON hga.id_horario = h.id_horario
        LEFT JOIN asignatura a ON hga.id_asignatura = a.id_asignatura
        WHERE hga.id_grupo = ?
        ORDER BY h.id_horario, hga.dia_semana
    ";
    
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
            'nombre_horario' => $row['nombre_horario'],
            'hora_inicio' => $row['hora_inicio'],
            'hora_fin' => $row['hora_fin'],
            'dia_semana' => intval($row['dia_semana']),
            'nombre_asignatura' => $row['nombre_asignatura']
        ];
    }
    
    echo json_encode([
        'success' => true,
        'horarios' => $horarios
    ]);
    
    $stmt->close();
    
} catch (Exception $e) {
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}

$conn->close();
?>