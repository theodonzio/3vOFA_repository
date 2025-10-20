<?php
include '../login/conexion_bd.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_docente = $_SESSION['id_usuario'];
    $id_espacio = $_POST['id_espacio'];
    $fecha_reserva = $_POST['fecha_reserva'];
    $id_horario = $_POST['id_horario'];
    $recursos_seleccionados = $_POST['recursos'] ?? []; // Recursos seleccionados

    // Obtener horas de la tabla horario
    $sql_h = "SELECT hora_inicio, hora_fin FROM horario WHERE id_horario = ?";
    $stmt_h = $conn->prepare($sql_h);
    $stmt_h->bind_param("i", $id_horario);
    $stmt_h->execute();
    $result_h = $stmt_h->get_result();
    $row_h = $result_h->fetch_assoc();
    $hora_inicio = $row_h['hora_inicio'];
    $hora_fin = $row_h['hora_fin'];
    $stmt_h->close();

    $fecha_inicio = $fecha_reserva . ' ' . $hora_inicio;
    $fecha_fin = $fecha_reserva . ' ' . $hora_fin;

    // Validación de fecha y hora
    date_default_timezone_set('America/Montevideo');
    $fecha_actual = new DateTime();
    $fecha_inicio_dt = new DateTime($fecha_inicio);
    if ($fecha_inicio_dt <= $fecha_actual) {
        header("Location: ../usuarios/docente.php?reserva=error_fecha");
        exit;
    }

    // Guardar reserva
    $sql = "INSERT INTO reserva (fecha_inicio, fecha_fin, tipo_reserva, estado, id_docente, id_espacio) VALUES (?, ?, 'Clase', 'Pendiente', ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $fecha_inicio, $fecha_fin, $id_docente, $id_espacio);
    if ($stmt->execute()) {
        $id_reserva = $stmt->insert_id; // Obtener ID de la reserva recién creada
        $stmt->close();

        // Insertar recursos seleccionados en reserva_recurso
        if (!empty($recursos_seleccionados)) {
            $stmt_rec = $conn->prepare("INSERT INTO reserva_recurso (id_reserva, id_recurso) VALUES (?, ?)");
            foreach ($recursos_seleccionados as $id_recurso) {
                $stmt_rec->bind_param("ii", $id_reserva, $id_recurso);
                $stmt_rec->execute();
            }
            $stmt_rec->close();
        }

        header("Location: ../usuarios/docente.php?reserva=success");
        exit;
    } else {
        header("Location: ../usuarios/docente.php?reserva=error");
        exit;
    }

    $conn->close();
}
?>