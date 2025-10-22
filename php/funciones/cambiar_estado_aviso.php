<?php
/**
 * Cambiar estado de avisos de inasistencia
 */
session_start();
header('Content-Type: application/json');

include '../login/conexion_bd.php';

// Verificar que sea adscripta
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    echo json_encode(['success' => false, 'mensaje' => 'No autorizado']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_aviso = isset($_POST['id_aviso']) ? intval($_POST['id_aviso']) : 0;
    $nuevo_estado = isset($_POST['nuevo_estado']) ? trim($_POST['nuevo_estado']) : '';
    $observaciones = isset($_POST['observaciones']) ? trim($_POST['observaciones']) : '';

    // Validar datos
    if ($id_aviso <= 0 || empty($nuevo_estado)) {
        echo json_encode(['success' => false, 'mensaje' => 'Datos incompletos']);
        exit;
    }

    // Validar que el estado sea válido
    $estados_validos = ['Pendiente', 'Visto', 'Resuelto'];
    if (!in_array($nuevo_estado, $estados_validos)) {
        echo json_encode(['success' => false, 'mensaje' => 'Estado no válido']);
        exit;
    }

    try {
        // Actualizar estado
        if ($nuevo_estado == 'Resuelto' && !empty($observaciones)) {
            $sql = "UPDATE aviso_inasistencia SET estado = ?, observaciones_adscripta = ? WHERE id_aviso = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $nuevo_estado, $observaciones, $id_aviso);
        } else {
            $sql = "UPDATE aviso_inasistencia SET estado = ? WHERE id_aviso = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $nuevo_estado, $id_aviso);
        }

        if ($stmt->execute()) {
            $mensaje = "Aviso marcado como " . strtolower($nuevo_estado);
            echo json_encode(['success' => true, 'mensaje' => $mensaje]);
        } else {
            throw new Exception($conn->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        error_log("Error en cambiar_estado_aviso.php: " . $e->getMessage());
        echo json_encode(['success' => false, 'mensaje' => 'Error al actualizar el estado']);
    }
} else {
    echo json_encode(['success' => false, 'mensaje' => 'Método no permitido']);
}

$conn->close();
?>