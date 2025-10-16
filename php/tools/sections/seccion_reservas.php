<?php
/**
 * Sección de Reservas de Docentes
 */
?>

<div id="tabla_reservas_adscripta" class="container my-5">
  <h2 class="mb-4 text-center" data-traducible="Reservas Realizadas por los Docentes" id="title_reserva">
    Reservas de los Docentes
  </h2>
  
  <div class="row">
    <?php
    if (!isset($conn)) {
        include '../login/conexion_bd.php';
    }
    
    $sql = "SELECT r.id_reserva, e.nombre_espacio, e.tipo AS tipo_salon,
                   DATE(r.fecha_inicio) AS fecha,
                   TIME(r.fecha_inicio) AS hora_inicio,
                   TIME(r.fecha_fin) AS hora_fin,
                   u.nombre AS nombre_docente, u.apellido AS apellido_docente,
                   r.estado
            FROM reserva r
            JOIN espacio e ON r.id_espacio = e.id_espacio
            JOIN usuario u ON r.id_docente = u.id_usuario
            ORDER BY 
                CASE 
                    WHEN r.estado = 'Pendiente' THEN 1
                    WHEN r.estado = 'Aprobada' THEN 2
                    ELSE 3
                END,
                r.fecha_inicio DESC";
    
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $estado = $row['estado'];
            
            // Configuración de colores según estado
            if ($estado == 'Pendiente') {
                $colorEstado = 'warning';
                $icono = 'clock';
                $textoColor = 'text-warning';
            } elseif ($estado == 'Aprobada') {
                $colorEstado = 'success';
                $icono = 'check-circle';
                $textoColor = 'text-success';
            } else {
                $colorEstado = 'danger';
                $icono = 'x-circle';
                $textoColor = 'text-danger';
            }
    ?>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-lg h-100 rounded-4 overflow-hidden">
                    <div class="card-header bg-<?php echo $colorEstado; ?> bg-gradient text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 d-flex align-items-center gap-2">
                            <i class="bi bi-<?php echo $icono; ?>"></i>
                            <?php echo htmlspecialchars($row['nombre_docente'] . ' ' . $row['apellido_docente']); ?>
                        </h5>
                        <span class="badge bg-light <?php echo $textoColor; ?> fw-bold">
                            <?php echo strtoupper($estado); ?>
                        </span>
                    </div>
                    
                    <div class="card-body">
                        <ul class="list-unstyled mb-3">
                            <li><strong>Salón:</strong> <?php echo htmlspecialchars($row['nombre_espacio'] . ' (' . $row['tipo_salon'] . ')'); ?></li>
                            <li><strong>Fecha:</strong> <?php echo htmlspecialchars($row['fecha']); ?></li>
                            <li><strong>Horario:</strong> <?php echo htmlspecialchars($row['hora_inicio'] . ' - ' . $row['hora_fin']); ?></li>
                        </ul>

                        <?php if ($estado == 'Pendiente') { ?>
                        <div class="d-flex gap-2">
                            <!-- BOTÓN APROBAR (VERDE) -->
                            <form action="../funciones/aprobar_reserva.php" method="POST" class="flex-fill">
                                <input type="hidden" name="id_reserva" value="<?php echo $row['id_reserva']; ?>">
                                <input type="hidden" name="accion" value="Aprobar">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="bi bi-check-lg"></i> Aprobar
                                </button>
                            </form>
                            
                            <!-- BOTÓN RECHAZAR (ROJO) -->
                            <form action="../funciones/aprobar_reserva.php" method="POST" class="flex-fill">
                                <input type="hidden" name="id_reserva" value="<?php echo $row['id_reserva']; ?>">
                                <input type="hidden" name="accion" value="Rechazar">
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="bi bi-x-lg"></i> Rechazar
                                </button>
                            </form>
                        </div>
                        <?php } ?>
                    </div>
                    
                    <div class="card-footer text-muted text-center small bg-light">
                        ID Reserva: <?php echo $row['id_reserva']; ?>
                    </div>
                </div>
            </div>
    <?php
        }
    } else {
        echo '<div class="col-12"><p class="text-center text-muted fs-5">No hay reservas registradas aún.</p></div>';
    }
    ?>
  </div>
</div>

<!-- Sin JavaScript - Los formularios funcionan directamente -->