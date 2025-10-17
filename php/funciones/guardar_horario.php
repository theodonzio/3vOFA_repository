<?php
header('Content-Type: application/json');
include_once '../login/conexion_bd.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['id_grupo']) || !isset($data['horarios'])) {
    echo json_encode([
        'titulo' => 'Error',
        'mensaje' => 'Datos incompletos',
        'icono' => 'error'
    ]);
    exit;
}

$id_grupo = intval($data['id_grupo']);
$horarios = $data['horarios'];

$conn->begin_transaction();

try {
    // Borrar horarios anteriores del grupo
    $del = $conn->prepare("DELETE FROM horario_grupo_asignatura WHERE id_grupo = ?");
    $del->bind_param("i", $id_grupo);
    $del->execute();
    $del->close();

    // Insertar los nuevos horarios
    $ins = $conn->prepare("INSERT INTO horario_grupo_asignatura (id_grupo, id_horario, dia_semana, id_asignatura) VALUES (?, ?, ?, ?)");
    
    foreach ($horarios as $h) {
        $id_horario = intval($h['id_horario']);
        $dia_semana = intval($h['dia_semana']);
        $id_asignatura = !empty($h['id_asignatura']) ? intval($h['id_asignatura']) : null;

        $ins->bind_param("iiii", $id_grupo, $id_horario, $dia_semana, $id_asignatura);
        $ins->execute();
    }

    $ins->close();
    $conn->commit();

    echo json_encode([
        'titulo' => 'Éxito',
        'mensaje' => 'Horarios guardados correctamente',
        'icono' => 'success'
    ]);

} catch (Exception $e) {
    $conn->rollback();
    error_log("Error en guardar_horario.php: " . $e->getMessage());
    echo json_encode([
        'titulo' => 'Error',
        'mensaje' => 'No se pudieron guardar los horarios',
        'icono' => 'error'
    ]);
}

$conn->close();