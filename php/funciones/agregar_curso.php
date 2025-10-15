<?php
include '../login/conexion_bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_curso = $_POST['nombre_curso'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $duracion_anos = $_POST['duracion_anos'] ?? null;
    $id_horarios = $_POST['id_horarios'] ?? [];

    if ($nombre_curso && $duracion_anos) {
        $stmt = $conn->prepare("INSERT INTO curso (nombre_curso, descripcion, duracion_anos) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nombre_curso, $descripcion, $duracion_anos);

        if ($stmt->execute()) {
            $id_curso = $conn->insert_id;

            // Guardar horarios del curso
            if (!empty($id_horarios)) {
                $insert = $conn->prepare("INSERT INTO curso_horario (id_curso, id_horario) VALUES (?, ?)");
                foreach ($id_horarios as $id_h) {
                    $id_h = intval($id_h);
                    $insert->bind_param("ii", $id_curso, $id_h);
                    $insert->execute();
                }
                $insert->close();
            }

            header("Location: ../usuarios/adscripta.php?curso=success");
            exit;
        } else {
            header("Location: ../usuarios/adscripta.php?curso=error");
            exit;
        }
    } else {
        header("Location: ../usuarios/adscripta.php?curso=error");
        exit;
    }
}
$conn->close();
?>
