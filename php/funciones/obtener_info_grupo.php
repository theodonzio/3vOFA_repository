<?php
/** Obtiene información de un grupo específico */

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

// Verifica conexión
if (!$conn) {
    echo json_encode([
        'error' => 'Error de conexión a la base de datos',
        'debug' => mysqli_connect_error()
    ]);
    exit;
}

try {
    // Obtiene información del grupo
    $sql = "
        SELECT 
            g.id_grupo,
            g.nombre_grupo,
            g.anio_curso,
            c.nombre_curso,
            t.nombre_turno
        FROM grupo g
        LEFT JOIN curso c ON g.id_curso = c.id_curso
        LEFT JOIN turno t ON g.id_turno = t.id_turno
        WHERE g.id_grupo = ?
    ";
    
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        echo json_encode([
            'error' => 'Error al preparar consulta',
            'debug' => $conn->error
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
    
    if ($result->num_rows > 0) {
        $grupo = $result->fetch_assoc();
        echo json_encode([
            'success' => true,
            'nombre_grupo' => $grupo['nombre_grupo'],
            'anio_curso' => $grupo['anio_curso'],
            'nombre_curso' => $grupo['nombre_curso'],
            'nombre_turno' => $grupo['nombre_turno']
        ]);
    } else {
        echo json_encode([
            'error' => 'Grupo no encontrado',
            'id_grupo_buscado' => $id_grupo
        ]);
    }
    
    $stmt->close();
    
} catch (Exception $e) {
    echo json_encode([
        'error' => 'Excepción capturada',
        'mensaje' => $e->getMessage()
    ]);
}

$conn->close();
?>