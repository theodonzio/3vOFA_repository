<?php
/**
 * Script de diagnóstico para sistema de horarios
 */
header('Content-Type: application/json');
include_once '../login/conexion_bd.php';

$id_grupo = isset($_GET['id_grupo']) ? intval($_GET['id_grupo']) : 0;

$debug = [
    'id_grupo' => $id_grupo,
    'grupo_info' => null,
    'curso_info' => null,
    'horarios_curso' => [],
    'asignaturas_grupo' => [],
    'horarios_guardados' => [],
    'errores' => []
];

try {
    // Información del grupo
    $sql = "SELECT g.*, c.nombre_curso FROM grupo g 
            LEFT JOIN curso c ON g.id_curso = c.id_curso 
            WHERE g.id_grupo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_grupo);
    $stmt->execute();
    $result = $stmt->get_result();
    $debug['grupo_info'] = $result->fetch_assoc();
    $stmt->close();

    if ($debug['grupo_info']) {
        $id_curso = $debug['grupo_info']['id_curso'];
        
        // Información del curso
        $sql = "SELECT * FROM curso WHERE id_curso = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_curso);
        $stmt->execute();
        $result = $stmt->get_result();
        $debug['curso_info'] = $result->fetch_assoc();
        $stmt->close();

        // Horarios del curso
        $sql = "SELECT ch.*, h.nombre_horario, h.hora_inicio, h.hora_fin 
                FROM curso_horario ch
                JOIN horario h ON ch.id_horario = h.id_horario
                WHERE ch.id_curso = ?
                ORDER BY h.hora_inicio";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_curso);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $debug['horarios_curso'][] = $row;
        }
        $stmt->close();

        // Asignaturas del grupo
        $sql = "SELECT a.* FROM grupo_asignatura ga
                JOIN asignatura a ON ga.id_asignatura = a.id_asignatura
                WHERE ga.id_grupo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_grupo);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $debug['asignaturas_grupo'][] = $row;
        }
        $stmt->close();

        // Horarios guardados
        $sql = "SELECT * FROM horario_grupo_asignatura WHERE id_grupo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_grupo);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $debug['horarios_guardados'][] = $row;
        }
        $stmt->close();
    }

} catch (Exception $e) {
    $debug['errores'][] = $e->getMessage();
}

echo json_encode($debug, JSON_PRETTY_PRINT);
$conn->close();