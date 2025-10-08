<?php
include '../login/conexion_bd.php';

if (!empty($_POST['nombre_asignatura']) && !empty($_POST['id_docente']) && !empty($_POST['id_grupo'])) {
    $nombre = $conn->real_escape_string($_POST['nombre_asignatura']);
    $docente = intval($_POST['id_docente']);
    $grupo = intval($_POST['id_grupo']);

    // Verificar o crear la asignatura
    $check = $conn->query("SELECT id_asignatura FROM asignatura WHERE nombre_asignatura = '$nombre'");
    if ($check->num_rows > 0) {
        $asig = $check->fetch_assoc();
        $id_asig = $asig['id_asignatura'];
    } else {
        $conn->query("INSERT INTO asignatura (nombre_asignatura) VALUES ('$nombre')");
        $id_asig = $conn->insert_id;
    }

    // Verificar si la relación ya existe
    $existe = $conn->query("SELECT * FROM grupo_asignatura 
                            WHERE id_grupo = $grupo 
                            AND id_asignatura = $id_asig 
                            AND id_docente = $docente");

    if ($existe->num_rows === 0) {
        // Solo inserta si no existe
        $sql = "INSERT INTO grupo_asignatura (id_grupo, id_asignatura, id_docente)
                VALUES ($grupo, $id_asig, $docente)";
        if ($conn->query($sql)) {
            header("Location: ../usuarios/adscripta.php?espacio=success");
            exit;
        } else {
            header("Location: ../usuarios/adscripta.php?espacio=error");
            exit;
        }
    } else {
        // Ya existe → redirige con mensaje de aviso
        header("Location: ../usuarios/adscripta.php?espacio=duplicado");
        exit;
    }
} else {
    header("Location: ../usuarios/adscripta.php?espacio=error");
    exit;
}
?>