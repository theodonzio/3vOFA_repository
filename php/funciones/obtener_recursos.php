<?php
/**
 * obtener_recursos.php
 * Devuelve los recursos asociados a un espacio en formato JSON
 */

include '../login/conexion_bd.php'; // Ajusta la ruta si es necesario

header('Content-Type: application/json; charset=utf-8');

$id_espacio = isset($_GET['id_espacio']) ? intval($_GET['id_espacio']) : 0;

if ($id_espacio > 0) {
    // Traer todos los recursos disponibles de ese espacio
    $sql = "SELECT id_recurso, nombre_recurso 
            FROM recurso 
            WHERE id_espacio = ? 
            ORDER BY nombre_recurso ASC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_espacio);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $recursos = [];
    while ($row = $result->fetch_assoc()) {
        $recursos[] = $row;
    }
    
    echo json_encode($recursos);
    $stmt->close();
    $conn->close();
} else {
    // Retornar array vacío si no hay id_espacio
    echo json_encode([]);
}
?>
