<?php
include '../login/conexion_bd.php';
header('Content-Type: application/json');

try {
    $data = json_decode(file_get_contents('php://input'), true);
    $ids = $data['ids'] ?? [];

    if (empty($ids)) {
        echo json_encode(["titulo" => "Error", "mensaje" => "No se recibieron horarios para eliminar.", "icono" => "error"]);
        exit;
    }

    $ids_list = implode(',', array_map('intval', $ids));

    $sql = "DELETE FROM horario WHERE id_horario IN ($ids_list)";
    if ($conn->query($sql)) {
        echo json_encode(["titulo" => "Eliminado", "mensaje" => "Los horarios seleccionados fueron eliminados correctamente.", "icono" => "success"]);
    } else {
        throw new Exception($conn->error);
    }

} catch (Exception $e) {
    echo json_encode(["titulo" => "Error", "mensaje" => "No se pueden eliminar horarios que estén en uso.", "icono" => "error"]);
}
?>
