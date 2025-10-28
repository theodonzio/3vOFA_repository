<!-- Tabla de Reservas del Docente -->
<div class="padre_tabla">
    <div class="container" id="tabla_reservas_docente">
        <h3 id="title_reservasdocente" data-traducible="Mis Reservas">Mis Reservas</h3>
        
        <?php
        if (!isset($conn)) {
            include '../login/conexion_bd.php';
        }
        
        if (!isset($id_docente)) {
            $id_docente = $_SESSION['id_usuario'];
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
                WHERE r.id_docente = ?
                ORDER BY r.fecha_inicio DESC";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_docente);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
        ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th data-traducible="Salón">Salón</th>
                            <th data-traducible="Tipo">Tipo</th>
                            <th data-traducible="Fecha">Fecha</th>
                            <th data-traducible="Horario">Horario</th>
                            <th data-traducible="Recursos">Recursos</th>
                            <th data-traducible="Estado">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { 
                            $estado = $row['estado'];
                            
                            // Clases de color según estado
                            if ($estado == 'Pendiente') {
                                $badge_class = 'bg-warning text-dark';
                                $icono = 'clock';
                            } elseif ($estado == 'Aprobada') {
                                $badge_class = 'bg-success';
                                $icono = 'check-circle-fill';
                            } else {
                                $badge_class = 'bg-danger';
                                $icono = 'x-circle-fill';
                            }
                            
                            // Obtener recursos de la reserva
                            $id_reserva = $row['id_reserva'];
                            $recursos_reserva = [];
                            $stmt_rec = $conn->prepare("SELECT rec.nombre_recurso, rec.tipo 
                                                        FROM reserva_recurso rr 
                                                        JOIN recurso rec ON rr.id_recurso = rec.id_recurso 
                                                        WHERE rr.id_reserva = ?");
                            $stmt_rec->bind_param("i", $id_reserva);
                            $stmt_rec->execute();
                            $result_rec = $stmt_rec->get_result();
                            while ($rec = $result_rec->fetch_assoc()) {
                                $nombre = htmlspecialchars($rec['nombre_recurso']);
                                $tipo = $rec['tipo'] ? ' (' . htmlspecialchars($rec['tipo']) . ')' : '';
                                $recursos_reserva[] = $nombre . $tipo;
                            }
                            $stmt_rec->close();
                            
                            $recursos_html = !empty($recursos_reserva) 
                                ? '<span class="badge bg-secondary me-1 mb-1">' . implode('</span><br><span class="badge bg-secondary me-1 mb-1">', $recursos_reserva) . '</span>' 
                                : '<em class="text-muted">Sin recursos</em>';
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['nombre_espacio']); ?></td>
                                <td><?php echo htmlspecialchars($row['tipo_salon']); ?></td>
                                <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                                <td><?php echo htmlspecialchars($row['hora_inicio'] . ' - ' . $row['hora_fin']); ?></td>
                                <td><?php echo $recursos_html; ?></td>
                                <td class="text-center">
                                  <span class="badge <?php echo $badge_class; ?> px-3 py-2" data-traducible="<?php echo ucfirst($estado); ?>">
                                      <?php echo htmlspecialchars($estado); ?>
                                  </span>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php
        } else {
            echo '<div class="alert alert-info text-center" role="alert">';
            echo '<i class="bi bi-info-circle me-2"></i>';
            echo '<span data-traducible="No tienes reservas registradas.">No tienes reservas registradas.</span>';
            echo '</div>';
        }
        
        $stmt->close();
        ?>
    </div>
</div>