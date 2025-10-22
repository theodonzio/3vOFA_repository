<?php
/**
 * Sección de Avisos de Inasistencia de Docentes
 * Para ser incluida en adscripta.php
 */
?>

<div id="seccionAvisosInasistencia" class="container my-5">
  <h2 class="mb-4 text-center">
    <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
    <span data-traducible="Avisos de Inasistencia">Avisos de Inasistencia</span>
  </h2>
  
  <p class="text-center text-muted mb-4">
    <span data-traducible="Gestiona los avisos de inasistencia de los docentes">
      Gestiona los avisos de inasistencia de los docentes
    </span>
  </p>

  <!-- Filtros -->
  <div class="d-flex justify-content-center mb-4">
    <div class="btn-group" role="group">
      <input type="radio" class="btn-check" name="filtroEstado" id="filtroTodos" value="todos" checked>
      <label class="btn btn-outline-primary" for="filtroTodos" data-traducible="Todos">Todos</label>

      <input type="radio" class="btn-check" name="filtroEstado" id="filtroPendientes" value="Pendiente">
      <label class="btn btn-outline-warning" for="filtroPendientes" data-traducible="Pendientes">Pendientes</label>

      <input type="radio" class="btn-check" name="filtroEstado" id="filtroVistos" value="Visto">
      <label class="btn btn-outline-info" for="filtroVistos" data-traducible="Vistos">Vistos</label>

      <input type="radio" class="btn-check" name="filtroEstado" id="filtroResueltos" value="Resuelto">
      <label class="btn btn-outline-success" for="filtroResueltos" data-traducible="Resueltos">Resueltos</label>
    </div>
  </div>

  <div class="row" id="contenedorAvisos">
    <?php
    if (!isset($conn)) {
        include '../login/conexion_bd.php';
    }
    
    $sql = "SELECT a.id_aviso, a.fecha_inasistencia, a.motivo, a.fecha_aviso, a.estado, a.observaciones_adscripta,
                   u.nombre, u.apellido, u.email
            FROM aviso_inasistencia a
            JOIN usuario u ON a.id_docente = u.id_usuario
            ORDER BY a.fecha_inasistencia ASC, a.fecha_aviso DESC";
    
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $estado = $row['estado'];
            
            // Colores según estado
            if ($estado == 'Pendiente') {
                $colorEstado = 'warning';
                $icono = 'exclamation-triangle';
                $textoColor = 'text-warning';
            } elseif ($estado == 'Visto') {
                $colorEstado = 'info';
                $icono = 'eye-fill';
                $textoColor = 'text-info';
            } else {
                $colorEstado = 'success';
                $icono = 'check-circle-fill';
                $textoColor = 'text-success';
            }

            // Formatear fechas
            $fecha_inasistencia = date('d/m/Y', strtotime($row['fecha_inasistencia']));
            $fecha_aviso = date('d/m/Y H:i', strtotime($row['fecha_aviso']));
            
            $docenteNombre = htmlspecialchars($row['nombre'] . ' ' . $row['apellido']);
            $email = htmlspecialchars($row['email']);
    ?>
            <div class="col-md-4 mb-4 aviso-card" data-estado="<?php echo $estado; ?>">
                <div class="card border-0 shadow-lg h-100 rounded-4 overflow-hidden">
                    <div class="card-header bg-<?php echo $colorEstado; ?> bg-gradient text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 d-flex align-items-center gap-2">
                            <i class="bi bi-<?php echo $icono; ?>"></i>
                            <?php echo $docenteNombre; ?>
                        </h5>
                        <span class="badge bg-light <?php echo $textoColor; ?> fw-bold">
                            <?php echo strtoupper($estado); ?>
                        </span>
                    </div>
                    
                    <div class="card-body">
                        <ul class="list-unstyled mb-3">
                            <li class="mb-2">
                                <i class="bi bi-calendar-x text-danger me-2"></i>
                                <strong data-traducible="Fecha Inasistencia:">Fecha Inasistencia:</strong> 
                                <?php echo $fecha_inasistencia; ?>
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-clock text-muted me-2"></i>
                                <strong data-traducible="Fecha Aviso:">Fecha Aviso:</strong> 
                                <?php echo $fecha_aviso; ?>
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-envelope text-primary me-2"></i>
                                <strong>Email:</strong> 
                                <a href="mailto:<?php echo $email; ?>" class="text-decoration-none">
                                    <?php echo $email; ?>
                                </a>
                            </li>
                            <?php if ($row['motivo']): ?>
                            <li class="mb-2">
                                <i class="bi bi-chat-left-text text-info me-2"></i>
                                <strong data-traducible="Motivo:">Motivo:</strong><br>
                                <small class="text-muted"><?php echo htmlspecialchars($row['motivo']); ?></small>
                            </li>
                            <?php endif; ?>
                            <?php if ($row['observaciones_adscripta']): ?>
                            <li class="mb-2">
                                <i class="bi bi-sticky text-success me-2"></i>
                                <strong data-traducible="Observaciones:">Observaciones:</strong><br>
                                <small class="text-muted"><?php echo htmlspecialchars($row['observaciones_adscripta']); ?></small>
                            </li>
                            <?php endif; ?>
                        </ul>

                        <?php if ($estado == 'Pendiente'): ?>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-info w-100 btn-marcar-visto" 
                                    data-id="<?php echo $row['id_aviso']; ?>">
                                <i class="bi bi-eye-fill"></i> <span data-traducible="Marcar como Visto">Marcar como Visto</span>
                            </button>
                        </div>
                        <?php elseif ($estado == 'Visto'): ?>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-success w-100 btn-marcar-resuelto" 
                                    data-id="<?php echo $row['id_aviso']; ?>">
                                <i class="bi bi-check-circle-fill"></i> <span data-traducible="Marcar como Resuelto">Marcar como Resuelto</span>
                            </button>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="card-footer text-muted text-center small bg-light">
                        <span data-traducible="ID Aviso:">ID Aviso:</span> <?php echo $row['id_aviso']; ?>
                    </div>
                </div>
            </div>
    <?php
        }
    } else {
        echo '<div class="col-12"><p class="text-center text-muted fs-5" data-traducible="No hay avisos de inasistencia registrados.">No hay avisos de inasistencia registrados.</p></div>';
    }
    ?>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filtrado de avisos
    const filtros = document.querySelectorAll('input[name="filtroEstado"]');
    const avisos = document.querySelectorAll('.aviso-card');

    filtros.forEach(filtro => {
        filtro.addEventListener('change', function() {
            const estadoFiltro = this.value;
            
            avisos.forEach(aviso => {
                const estadoAviso = aviso.getAttribute('data-estado');
                
                if (estadoFiltro === 'todos' || estadoAviso === estadoFiltro) {
                    aviso.style.display = 'block';
                } else {
                    aviso.style.display = 'none';
                }
            });
        });
    });

    // Marcar como visto
    document.querySelectorAll('.btn-marcar-visto').forEach(btn => {
        btn.addEventListener('click', function() {
            const idAviso = this.getAttribute('data-id');
            
            Swal.fire({
                title: '¿Marcar como visto?',
                text: 'El docente sabrá que has visto su aviso de inasistencia',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0dcaf0',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, marcar como visto',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    cambiarEstadoAviso(idAviso, 'Visto');
                }
            });
        });
    });

    // Marcar como resuelto
    document.querySelectorAll('.btn-marcar-resuelto').forEach(btn => {
        btn.addEventListener('click', async function() {
            const idAviso = this.getAttribute('data-id');
            
            const { value: observaciones } = await Swal.fire({
                title: 'Marcar como resuelto',
                html: `
                    <div class="text-start">
                        <label class="form-label">Observaciones (opcional):</label>
                        <textarea id="swal-observaciones" class="form-control" rows="3" 
                                  placeholder="Agrega observaciones sobre cómo se resolvió la inasistencia..."></textarea>
                    </div>
                `,
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Marcar como resuelto',
                cancelButtonText: 'Cancelar',
                preConfirm: () => {
                    return document.getElementById('swal-observaciones').value;
                }
            });

            if (observaciones !== undefined) {
                cambiarEstadoAviso(idAviso, 'Resuelto', observaciones);
            }
        });
    });

    function cambiarEstadoAviso(idAviso, nuevoEstado, observaciones = '') {
        const formData = new FormData();
        formData.append('id_aviso', idAviso);
        formData.append('nuevo_estado', nuevoEstado);
        formData.append('observaciones', observaciones);

        fetch('../funciones/cambiar_estado_aviso.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado!',
                    text: data.mensaje,
                    confirmButtonColor: '#198754'
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.mensaje,
                    confirmButtonColor: '#dc3545'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo actualizar el estado del aviso',
                confirmButtonColor: '#dc3545'
            });
        });
    }
});
</script>

<style>
/* Animación para las tarjetas */
.aviso-card {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Modo oscuro */
body.oscuro .aviso-card .card {
    background-color: #2c2c2c !important;
    color: #f5f5f5 !important;
}

body.oscuro .aviso-card .card-footer {
    background-color: #3a3a3a !important;
    color: #cfcfcf !important;
}
</style>