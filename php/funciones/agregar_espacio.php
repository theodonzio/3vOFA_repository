<?php
include '../login/conexion_bd.php'; // Conexión a la BD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_salon = $_POST['tipo_salon'];
    $descripcion = $_POST['descripcion'];
    $recursos = $_POST['recursos'] ?? [];

    // Insertar el nuevo espacio
    $sql = "INSERT INTO espacio (nombre_espacio, tipo) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $descripcion, $tipo_salon);

    if ($stmt->execute()) {
        $id_espacio = $stmt->insert_id;
        $stmt->close();

        // Actualizar los recursos seleccionados para asignarlos a este espacio
        if (!empty($recursos)) {
            $stmt_rec = $conn->prepare("UPDATE recurso SET id_espacio = ?, estado = 'Disponible' WHERE id_recurso = ?");
            foreach ($recursos as $id_recurso) {
                $id_recurso = intval($id_recurso);
                $stmt_rec->bind_param("ii", $id_espacio, $id_recurso);
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