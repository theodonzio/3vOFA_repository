<?php
include '../login/conexion_bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre_recurso']);
    $tipo = trim($_POST['tipo']);
    $id_espacio = intval($_POST['id_espacio']);

    if ($nombre && $id_espacio > 0) {
        $sql = "INSERT INTO recurso (nombre_recurso, tipo, id_espacio) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $nombre, $tipo, $id_espacio);
        $stmt->execute();
        $stmt->close();
        header("Location: ../PaginasAdscriptas/recursos.php?success=1");
    } else {
        header("Location: ../PaginasAdscriptas/recursos.php?error=1");
    }

    $conn->close();
}
?>
