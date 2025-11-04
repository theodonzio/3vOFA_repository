<?php
include '../login/conexion_bd.php';

// Validar que existan los datos
if (!isset($_POST['id_horario']) || !isset($_POST['nombre_horario']) || 
    !isset($_POST['hora_inicio']) || !isset($_POST['hora_fin'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Datos incompletos']);
    exit();
}

$id = intval($_POST['id_horario']);
$nombre = trim($_POST['nombre_horario']);
$inicio = $_POST['hora_inicio'];
$fin = $_POST['hora_fin'];

// Validar que el nombre no esté vacío
if (empty($nombre)) {
    http_response_code(400);
    echo json_encode(['error' => 'El nombre del horario es obligatorio']);
    exit();
}

// Usar prepared statement para evitar SQL injection
$sql = "UPDATE horario 
        SET nombre_horario = ?, hora_inicio = ?, hora_fin = ? 
        WHERE id_horario = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $nombre, $inicio, $fin, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'mensaje' => 'Horario actualizado correctamente']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Error al actualizar: ' . $conn->error]);
}

$stmt->close();
$conn->close();
?>