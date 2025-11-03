<?php
/**
 * Obtiene horarios de un grupo específico para estudiantes
 */

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../login/conexion_bd.php';

// Valida parámetro
if (!isset($_GET['id_grupo'])) {
    echo json_encode([
        'error' => 'No se especificó grupo',
        'debug' => 'Parámetro id_grupo no recibido'
    ]);
    exit;
}

$id_grupo = intval($_GET['id_grupo']);

// Verifica conexión a BD
if (!$conn) {
    echo json_encode([
        'error' => 'Error de conexión a la base de datos',
        'debug' => mysqli_connect_error()
    ]);
    exit;
}

try {
    // Obtiene horarios del grupo con sus asignaturas
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
        echo json_encode([
            'error' => 'Error al preparar consulta',
            'debug' => $conn->error,
            'sql' => $sql
        ]);
        exit;
    }
    
    $stmt->bind_param("i", $id_grupo);
    
    if (!$stmt->execute()) {
        echo json_encode([
            'error' => 'Error al ejecutar consulta',
            'debug' => $stmt->error
        ]);
        exit;
    }
    
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
        'horarios' => $horarios,
        'total' => count($horarios),
        'id_grupo_consultado' => $id_grupo
    ]);
    
    $stmt->close();
    
} catch (Exception $e) {
    echo json_encode([
        'error' => 'Excepción capturada',
        'mensaje' => $e->getMessage(),
        'linea' => $e->getLine()
    ]);
}

$conn->close();
?>