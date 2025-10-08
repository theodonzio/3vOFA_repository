<?php
include '../login/conexion_bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_curso = $_POST['nombre_curso'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $duracion_anos = $_POST['duracion_anos'] ?? null;

    if ($nombre_curso && $duracion_anos) {
        $stmt = $conn->prepare("INSERT INTO curso (nombre_curso, descripcion, duracion_anos) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nombre_curso, $descripcion, $duracion_anos);

        if ($stmt->execute()) {
            header("Location: ../usuarios/adscripta.php?curso=success");
        } else {
            header("Location: ../usuarios/adscripta.php?curso=error");
        }
    } else {
        header("Location: ../usuarios/adscripta.php?curso=error");
    }
    $stmt->close();
}
$conn->close();
