<?php
/**
 * Sección de Reservas de Docentes con SweetAlert2
 */
?>

<div id="tabla_reservas_adscripta" class="container my-5">
  <h2 class="mb-4 text-center" data-traducible="Reservas de los Docentes" id="title_reserva">
    Reservas de los Docentes
  </h2>
  
  <div class="row">
    <?php
    if (!isset($conn)) {
        include '../login/conexion_bd.php';
    }
    
    // SQL modificado: mostrar reservas hasta que pase su fecha_fin
    $sql = "SELECT r.id_reserva, e.nombre_espacio, e.tipo AS tipo_salon,
                   DATE(r.fecha_inicio) AS fecha,
                   TIME(r.fecha_inicio) AS hora_inicio,
                   TIME(r.fecha_fin) AS hora_fin,
                   r.fecha_fin AS fecha_fin_completa,
                   u.nombre AS nombre_docente, u.apellido AS apellido_docente,
                   r.estado
            FROM reserva r
            JOIN espacio e ON r.id_espacio = e.id_espacio
            JOIN usuario u ON r.id_docente = u.id_usuario
            WHERE r.fecha_fin >= NOW()
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
            
            // Escapar datos para JavaScript
            $docenteJs = htmlspecialchars($row['nombre_docente'] . ' ' . $row['apellido_docente'], ENT_QUOTES);
            $salonJs = htmlspecialchars($row['nombre_espacio'], ENT_QUOTES);
            $fechaJs = htmlspecialchars($row['fecha'], ENT_QUOTES);
            $horarioJs = htmlspecialchars($row['hora_inicio'] . ' - ' . $row['hora_fin'], ENT_QUOTES);
    ?>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-lg h-100 rounded-4 overflow-hidden">
                    <div class="card-header bg-<?php echo $colorEstado; ?> bg-gradient text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 d-flex align-items-center gap-2">
                            <i class="bi bi-<?php echo $icono; ?>"></i>
                            <?php echo htmlspecialchars($row['nombre_docente'] . ' ' . $row['apellido_docente']); ?>
                        </h5>
                        <span class="badge bg-light <?php echo $textoColor; ?> fw-bold" data-traducible="<?php echo strtoupper($estado); ?>">
                            <?php echo strtoupper($estado); ?>
                        </span>
                    </div>
                    
                    <div class="card-body">
                        <ul class="list-unstyled mb-3">
                            <li><strong data-traducible="Salón:">Salón:</strong> <?php echo htmlspecialchars($row['nombre_espacio'] . ' (' . $row['tipo_salon'] . ')'); ?></li>
                            <li><strong data-traducible="Fecha:">Fecha:</strong> <?php echo htmlspecialchars($row['fecha']); ?></li>
                            <li><strong data-traducible="Horario:">Horario:</strong> <?php echo htmlspecialchars($row['hora_inicio'] . ' - ' . $row['hora_fin']); ?></li>
                        </ul>

                        <?php if ($estado == 'Pendiente') { ?>
                        <div class="d-flex gap-2">
                            <!-- BOTÓN APROBAR -->
                            <button type="button" class="btn btn-success w-100 flex-fill btn-aprobar-reserva" 
                                    data-id="<?php echo $row['id_reserva']; ?>"
                                    data-docente="<?php echo $docenteJs; ?>"
                                    data-salon="<?php echo $salonJs; ?>"
                                    data-fecha="<?php echo $fechaJs; ?>"
                                    data-horario="<?php echo $horarioJs; ?>">
                                <i class="bi bi-check-lg"></i> <span data-traducible="Aprobar">Aprobar</span>
                            </button>
                            
                            <!-- BOTÓN RECHAZAR -->
                            <button type="button" class="btn btn-danger w-100 flex-fill btn-rechazar-reserva" 
                                    data-id="<?php echo $row['id_reserva']; ?>"
                                    data-docente="<?php echo $docenteJs; ?>"
                                    data-salon="<?php echo $salonJs; ?>"
                                    data-fecha="<?php echo $fechaJs; ?>"
                                    data-horario="<?php echo $horarioJs; ?>">
                                <i class="bi bi-x-lg"></i> <span data-traducible="Rechazar">Rechazar</span>
                            </button>
                        </div>
                        <?php } ?>
                    </div>
                    
                    <div class="card-footer text-muted text-center small bg-light">
                        <span data-traducible="ID Reserva:">ID Reserva:</span> <?php echo $row['id_reserva']; ?>
                    </div>
                </div>
            </div>
    <?php
        }
    } else {
        echo '<div class="col-12"><p class="text-center text-muted fs-5" data-traducible="No hay reservas registradas aún.">No hay reservas registradas aún.</p></div>';
    }
    ?>
  </div>
</div>

<script src="../../../js/traductor.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Script de reservas cargado');
    
    // Función para detectar modo oscuro
    function isDarkMode() {
        return document.body.classList.contains('oscuro');
    }
    
    // Función para aprobar reserva
    document.querySelectorAll('.btn-aprobar-reserva').forEach(btn => {
        btn.addEventListener('click', function() {
            const idReserva = this.getAttribute('data-id');
            const docente = this.getAttribute('data-docente');
            const salon = this.getAttribute('data-salon');
            const fecha = this.getAttribute('data-fecha');
            const horario = this.getAttribute('data-horario');
            
            const dark = isDarkMode();
            
            Swal.fire({
                title: '¿Aprobar esta reserva?',
                html: `
                    <div class="text-start">
                        <p><strong>Docente:</strong> ${docente}</p>
                        <p><strong>Salón:</strong> ${salon}</p>
                        <p><strong>Fecha:</strong> ${fecha}</p>
                        <p><strong>Horario:</strong> ${horario}</p>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="bi bi-check-lg"></i> Sí, aprobar',
                cancelButtonText: '<i class="bi bi-x-lg"></i> Cancelar',
                background: dark ? '#2c2c2c' : '#fff',
                color: dark ? '#f5f5f5' : '#212529'
            }).then((result) => {
                if (result.isConfirmed) {
                    enviarAccion(idReserva, 'Aprobar');
                }
            });
        });
    });
    
    // Función para rechazar reserva
    document.querySelectorAll('.btn-rechazar-reserva').forEach(btn => {
        btn.addEventListener('click', function() {
            const idReserva = this.getAttribute('data-id');
            const docente = this.getAttribute('data-docente');
            const salon = this.getAttribute('data-salon');
            const fecha = this.getAttribute('data-fecha');
            const horario = this.getAttribute('data-horario');
            
            const dark = isDarkMode();
            
            Swal.fire({
                title: '¿Rechazar esta reserva?',
                html: `
                    <div class="text-start">
                        <p><strong>Docente:</strong> ${docente}</p>
                        <p><strong>Salón:</strong> ${salon}</p>
                        <p><strong>Fecha:</strong> ${fecha}</p>
                        <p><strong>Horario:</strong> ${horario}</p>
                        <p class="text-danger mt-3"><small><i class="bi bi-exclamation-triangle"></i> Esta acción no se puede deshacer.</small></p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="bi bi-trash"></i> Sí, rechazar',
                cancelButtonText: '<i class="bi bi-x-lg"></i> Cancelar',
                background: dark ? '#2c2c2c' : '#fff',
                color: dark ? '#f5f5f5' : '#212529'
            }).then((result) => {
                if (result.isConfirmed) {
                    enviarAccion(idReserva, 'Rechazar');
                }
            });
        });
    });
    
    // Función para enviar acción
    function enviarAccion(idReserva, accion) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '../funciones/aprobar_reserva.php';
        
        const inputId = document.createElement('input');
        inputId.type = 'hidden';
        inputId.name = 'id_reserva';
        inputId.value = idReserva;
        
        const inputAccion = document.createElement('input');
        inputAccion.type = 'hidden';
        inputAccion.name = 'accion';
        inputAccion.value = accion;
        
        const inputSweetAlert = document.createElement('input');
        inputSweetAlert.type = 'hidden';
        inputSweetAlert.name = 'use_sweetalert';
        inputSweetAlert.value = '1';
        
        form.appendChild(inputId);
        form.appendChild(inputAccion);
        form.appendChild(inputSweetAlert);
        document.body.appendChild(form);
        form.submit();
    }
    
    // Mostrar resultado después de la acción
    <?php if (isset($_GET['success']) && isset($_GET['accion'])): ?>
        const dark = isDarkMode();
        
        <?php if ($_GET['accion'] == 'Aprobar'): ?>
            Swal.fire({
                icon: 'success',
                title: '¡Reserva Aprobada!',
                text: 'La reserva ha sido aprobada exitosamente.',
                confirmButtonColor: '#198754',
                confirmButtonText: 'Aceptar',
                timer: 3000,
                timerProgressBar: true,
                background: dark ? '#2c2c2c' : '#fff',
                color: dark ? '#f5f5f5' : '#212529'
            });
        <?php elseif ($_GET['accion'] == 'Rechazar'): ?>
            Swal.fire({
                icon: 'error',
                title: 'Reserva Rechazada',
                text: 'La reserva ha sido rechazada correctamente.',
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Aceptar',
                timer: 3000,
                timerProgressBar: true,
                background: dark ? '#2c2c2c' : '#fff',
                color: dark ? '#f5f5f5' : '#212529'
            });
        <?php endif; ?>
        
        // Limpiar URL
        const url = new URL(window.location);
        url.searchParams.delete('success');
        url.searchParams.delete('accion');
        window.history.replaceState({}, document.title, url);
    <?php endif; ?>
});
</script>

<style>
/* Estilos para SweetAlert en modo oscuro */
body.oscuro .swal2-popup {
    background-color: #2c2c2c !important;
    color: #f5f5f5 !important;
}

body.oscuro .swal2-title {
    color: #f5f5f5 !important;
}

body.oscuro .swal2-html-container {
    color: #f5f5f5 !important;
}

body.oscuro .swal2-icon.swal2-question {
    border-color: #6ea8fe !important;
    color: #6ea8fe !important;
}

body.oscuro .swal2-icon.swal2-warning {
    border-color: #ffc107 !important;
    color: #ffc107 !important;
}
</style>