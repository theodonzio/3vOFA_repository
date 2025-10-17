<?php
include '../login/conexion_bd.php';

if (isset($_POST['nombre_grupo'], $_POST['anio_curso'], $_POST['id_curso'], $_POST['id_turno'])) {
    $nombre_grupo = trim($_POST['nombre_grupo']);
    $anio_curso = intval($_POST['anio_curso']);
    $id_curso = intval($_POST['id_curso']);
    $id_turno = intval($_POST['id_turno']);

    $sql = "INSERT INTO grupo (nombre_grupo, anio_curso, id_curso, id_turno) 
            VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siii", $nombre_grupo, $anio_curso, $id_curso, $id_turno);

    if ($stmt->execute()) {
        header("Location: ../usuarios/adscripta.php?grupo=success");
        exit;
    } else {
        header("Location: ../usuarios/adscripta.php?grupo=error");
        exit;
    }
    
    $stmt->close();
} else {
    header("Location: ../usuarios/adscripta.php?grupo=error");
    exit;
}

$conn->close();
?>