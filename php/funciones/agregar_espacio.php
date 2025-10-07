<?php
include '../login/conexion_bd.php'; // Conexión a la BD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_salon = $_POST['tipo_salon'];
    $descripcion = $_POST['descripcion'];
    $recursos = $_POST['opciones'] ?? [];

    // Insertar el nuevo espacio
    $sql = "INSERT INTO espacio (nombre_espacio, tipo) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $descripcion, $tipo_salon);

    if ($stmt->execute()) {
        $id_espacio = $stmt->insert_id;
        $stmt->close();

        // Insertar los recursos asociados al espacio
        if (!empty($recursos)) {
            $stmt_rec = $conn->prepare("INSERT INTO recurso (nombre_recurso, tipo, estado, id_espacio) VALUES (?, 'General', 'Disponible', ?)");
            foreach ($recursos as $recurso) {
                $stmt_rec->bind_param("si", $recurso, $id_espacio);
                $stmt_rec->execute();
            }
            $stmt_rec->close();
        }

        // Redirigir con parámetro de éxito para SweetAlert
        header("Location: ../usuarios/adscripta.php?espacio=success");
        exit;

    } else {
        // Redirigir con parámetro de error para SweetAlert
        header("Location: ../usuarios/adscripta.php?espacio=error");
    }

    $stmt->close();
    $conn->close();
}
?>