<?php
include '../login/conexion_bd.php'; // Ajusta la ruta si es necesario

if (isset($_GET['id_espacio'])) {
    $id_espacio = intval($_GET['id_espacio']);
    
    $sql = "SELECT id_recurso, nombre_recurso FROM recurso WHERE id_espacio = ? AND estado = 'Disponible'";
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
    echo json_encode([]);
}
?>