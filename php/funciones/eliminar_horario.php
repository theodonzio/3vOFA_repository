<?php
include '../login/conexion_bd.php';
header('Content-Type: application/json');

try {
    $data = json_decode(file_get_contents('php://input'), true);
    $ids = $data['ids'] ?? [];

    if (empty($ids)) {
        echo json_encode([
            "titulo" => "Error", 
            "mensaje" => "No se recibieron horarios para eliminar.", 
            "icono" => "error"
        ]);
        exit;
    }

    // Valida que todos sean números
    $ids = array_map('intval', $ids);
    $ids = array_filter($ids, function($id) { return $id > 0; });

    if (empty($ids)) {
        echo json_encode([
            "titulo" => "Error", 
            "mensaje" => "IDs de horarios inválidos.", 
            "icono" => "error"
        ]);
        exit;
    }

    $ids_list = implode(',', $ids);

    // Verifica si están en uso
    $check = $conn->query("SELECT COUNT(*) as count FROM curso_horario WHERE id_horario IN ($ids_list)");
    $row = $check->fetch_assoc();
    
    if ($row['count'] > 0) {
        echo json_encode([
            "titulo" => "Error", 
            "mensaje" => "No se pueden eliminar horarios que están asignados a cursos. Primero desasígnalos de los cursos.", 
            "icono" => "error"
        ]);
        exit;
    }

    // Elimina horarios
    $sql = "DELETE FROM horario WHERE id_horario IN ($ids_list)";
    
    if ($conn->query($sql)) {
        $eliminados = $conn->affected_rows;
        echo json_encode([
            "titulo" => "Eliminado", 
            "mensaje" => "Se eliminaron $eliminados horario(s) correctamente.", 
            "icono" => "success"
        ]);
    } else {
        throw new Exception($conn->error);
    }

} catch (Exception $e) {
    error_log("Error en eliminar_horario.php: " . $e->getMessage());
    echo json_encode([
        "titulo" => "Error", 
        "mensaje" => "Error al eliminar los horarios: " . $e->getMessage(), 
        "icono" => "error"
    ]);
}

$conn->close();
?>