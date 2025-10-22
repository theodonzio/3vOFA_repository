<?php
/**
 * Sección de Mis Avisos de Inasistencia para Docentes
 */
?>

<div id="misAvisosInasistencia" class="container my-5">
  <h3 class="mb-4 text-center">
    <i class="bi bi-calendar-x text-warning me-2"></i>
    <span data-traducible="Mis Avisos de Inasistencia">Mis Avisos de Inasistencia</span>
  </h3>

  <div class="table-responsive shadow rounded">
    <table class="table table-bordered table-striped table-hover align-middle mb-0">
      <thead class="table-warning">
        <tr>
          <th data-traducible="Fecha Inasistencia">Fecha Inasistencia</th>
          <th data-traducible="Motivo">Motivo</th>
          <th data-traducible="Fecha Aviso">Fecha Aviso</th>
          <th data-traducible="Estado">Estado</th>
          <th data-traducible="Observaciones">Observaciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (!isset($conn)) {
            include '../login/conexion_bd.php';
        }
        
        if (!isset($id_docente)) {
            $id_docente = $_SESSION['id_usuario'];
        }
        
        $sql = "SELECT id_aviso, fecha_inasistencia, motivo, fecha_aviso, estado, observaciones_adscripta
                FROM aviso_inasistencia
                WHERE id_docente = ?
                ORDER BY fecha_inasistencia DESC";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_docente);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $estado = $row['estado'];
                
                // Clases de color según estado
                if ($estado == 'Pendiente') {
                    $badge_class = 'bg-warning text-dark';
                    $icono = 'clock';
                } elseif ($estado == 'Visto') {
                    $badge_class = 'bg-info';
                    $icono = 'eye-fill';
                } else {
                    $badge_class = 'bg-success';
                    $icono = 'check-circle-fill';
                }
                
                $fecha_inasistencia = date('d/m/Y', strtotime($row['fecha_inasistencia']));
                $fecha_aviso = date('d/m/Y H:i', strtotime($row['fecha_aviso']));
        ?>
                <tr>
                    <td class="fw-bold text-danger">
                        <i class="bi bi-calendar-x me-1"></i>
                        <?php echo $fecha_inasistencia; ?>
                    </td>
                    <td>
                        <?php echo $row['motivo'] ? htmlspecialchars($row['motivo']) : '<em class="text-muted">Sin motivo especificado</em>'; ?>
                    </td>
                    <td>
                        <small class="text-muted">
                            <i class="bi bi-clock me-1"></i>
                            <?php echo $fecha_aviso; ?>
                        </small>
                    </td>
                    <td class="text-center">
                        <span class="badge <?php echo $badge_class; ?> px-3 py-2">
                            <i class="bi bi-<?php echo $icono; ?> me-1"></i>
                            <?php echo htmlspecialchars($estado); ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($row['observaciones_adscripta']): ?>
                            <i class="bi bi-sticky text-success me-1"></i>
                            <small><?php echo htmlspecialchars($row['observaciones_adscripta']); ?></small>
                        <?php else: ?>
                            <em class="text-muted">—</em>
                        <?php endif; ?>
                    </td>
                </tr>
        <?php
            }
            $stmt->close();
        } else {
            echo '<tr><td colspan="5" class="text-center py-4">';
            echo '<i class="bi bi-info-circle me-2"></i>';
            echo '<span data-traducible="No tienes avisos de inasistencia registrados.">No tienes avisos de inasistencia registrados.</span>';
            echo '</td></tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<style>
/* Modo oscuro para la tabla de avisos */
body.oscuro #misAvisosInasistencia .table {
    background-color: #2b2b2b;
    color: #f5f5f5;
}

body.oscuro #misAvisosInasistencia .table thead th {
    background-color: #e0a800 !important;
    color: #000 !important;
}

body.oscuro #misAvisosInasistencia .table tbody td {
    background-color: #3a3a3a;
    color: #f5f5f5;
    border-color: #555;
}

body.oscuro #misAvisosInasistencia .table-striped tbody tr:nth-of-type(odd) td {
    background-color: #383838;
}

body.oscuro #misAvisosInasistencia .table tbody tr:hover td {
    background-color: #505050;
}

/* Responsive */
@media (max-width: 768px) {
    #misAvisosInasistencia .table {
        font-size: 0.85rem;
    }
    
    #misAvisosInasistencia .table thead th,
    #misAvisosInasistencia .table tbody td {
        padding: 0.5rem 0.25rem;
    }
    
    #misAvisosInasistencia .badge {
        font-size: 0.75rem;
        padding: 0.35rem 0.5rem;
    }
}
</style>