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
        echo "<script>alert('Grupo agregado correctamente'); window.location='../usuarios/adscripta.php';</script>";
    } else {
        echo "<script>alert('Error al agregar el grupo'); window.location='../usuarios/adscripta.php';</script>";
    }
    
    $stmt->close();
} else {
    echo "<script>alert('Datos incompletos'); window.location='../usuarios/adscripta.php';</script>";
}

$conn->close();
?>