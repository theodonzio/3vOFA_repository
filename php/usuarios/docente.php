<?php
session_start();

// Verificar sesión
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 2) {
    header("Location: ../index.php?login=" . (!isset($_SESSION['id_usuario']) ? 'required' : 'unauthorized'));
    exit;
}

include '../tools/head.php';
include '../tools/headers/header_docente.php';
include '../login/conexion_bd.php';
$id_docente = $_SESSION['id_usuario'];
?>

<body>

<!-- Título Principal -->
<div class="text-center titulo-adscripta">
    <img src="../../img/ofalogos/blue-logo.png" class="tinylogo"> 
    <img src="../../img/blueicons/docenteblue.png" class="blue_icon"> 
    <h1 class="display-4 fw-bold text-primary" data-traducible="Sistema de Gestión">Sistema de Gestión</h1>
    <p class="lead text-muted" data-traducible="Panel exclusivo para Docentes">Panel exclusivo para Docentes</p>
    <?php include '../tools/reloj.php'; ?>
</div>

<!-- Sección de Horarios -->
<?php include '../tools/sections/seccion_horarios_docente.php'; ?>

<!-- Hero Reservas -->
<div class="hero hero-imagen text-white d-flex align-items-center justify-content-center py-5" 
     style="background-image: url('https://images.unsplash.com/photo-1604134967494-8a9ed3adea0d?q=80&w=1974&auto=format&fit=crop');">
    <div class="hero-overlay"></div>
    <div class="container text-center hero-content">
        <h2 class="display-6 fw-semibold mb-3" data-traducible="Sistema de Reservas">Sistema de Reservas</h2>
        <p class="mb-4 fs-5" data-traducible="Desde aquí podés solicitar espacios">Desde aquí podés solicitar espacios</p>
        <div class="d-flex justify-content-center gap-3">
            <button class="btn btn-success btn-lg shadow-sm btn_wicon" data-bs-toggle="modal" data-bs-target="#realizarReservaModal">
                <i class="bi bi-bookmark-fill"></i> 
                <span data-traducible="Realizar Reserva">Realizar Reserva</span>
            </button>
        </div>
    </div>
</div>

<!-- Modal Realizar Reserva -->
<div class="modal fade" id="realizarReservaModal" tabindex="-1" aria-labelledby="realizarReservaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="../funciones/realizar_reserva.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="realizarReservaLabel" data-traducible="Realizar Reserva">Realizar Reserva</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" data-traducible="Selecciona un Espacio">Selecciona un Espacio</label>
                        <select name="id_espacio" id="nombre_salon" class="form-select" required>
                            <option value="" data-traducible="Seleccione un salón">Seleccione un salón</option>
                            <?php
                            $sql = "SELECT id_espacio, nombre_espacio, tipo FROM espacio ORDER BY nombre_espacio ASC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $nombre = htmlspecialchars($row['nombre_espacio'] . ' (' . $row['tipo'] . ')');
                                    echo "<option value='".$row['id_espacio']."'>{$nombre}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" data-traducible="Fecha">Fecha</label>
                        <input type="date" name="fecha_reserva" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" data-traducible="Horario">Horario</label>
                        <select name="id_horario" class="form-select" required>
                            <option value="" data-traducible="Seleccione un horario">Seleccione un horario</option>
                            <?php
                            $sql = "SELECT id_horario, nombre_horario, hora_inicio, hora_fin FROM horario ORDER BY id_horario ASC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $horario = htmlspecialchars($row['nombre_horario'] . ' (' . $row['hora_inicio'] . ' - ' . $row['hora_fin'] . ')');
                                    echo "<option value='".$row['id_horario']."'>{$horario}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Nueva sección para recursos -->
                    <div class="mb-3" id="recursos-container" style="display: none;">
                        <label class="form-label" data-traducible="Selecciona los recursos">Selecciona los recursos</label>
                        <div id="recursos-list"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-traducible="Cancelar">Cancelar</button>
                    <button type="submit" class="btn btn-success submit_btn" data-traducible="Reservar">Reservar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tabla de Mis Reservas -->
<?php include '../tools/sections/tabla_reservas_docente.php'; ?>

<!-- Botón scroll top -->
<a href="#top" id="scrollTopBtn" class="btn btn-secondary shadow-lg position-fixed bottom-0 end-0 m-4" 
   style="z-index:999; font-size:28px; opacity:0; transform: translateY(20px); transition: opacity 0.5s, transform 0.5s;">
    <i class="bi bi-caret-up-fill"></i>
</a>

<?php include '../tools/footer.php'; ?>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/modoClaroOscuro.js"></script>
<script src="../../js/traductor.js"></script>
<script src="../../js/scroll-top.js"></script>

<?php if (isset($_GET['reserva'])): ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const isDark = document.body.classList.contains('oscuro');
  
  <?php if ($_GET['reserva'] === 'success'): ?>
    Swal.fire({
      icon: 'success',
      title: '¡Reserva realizada!',
      text: 'Tu reserva fue registrada correctamente.',
      confirmButtonColor: '#198754',
      background: isDark ? '#2c2c2c' : '#fff',
      color: isDark ? '#f5f5f5' : '#212529'
    });
  <?php elseif ($_GET['reserva'] === 'error_fecha'): ?>
    Swal.fire({
      icon: 'error',
      title: 'Fecha u hora inválida',
      text: 'No puedes reservar en una fecha u hora pasada.',
      confirmButtonColor: '#dc3545',
      background: isDark ? '#2c2c2c' : '#fff',
      color: isDark ? '#f5f5f5' : '#212529'
    });
  <?php elseif ($_GET['reserva'] === 'error'): ?>
    Swal.fire({
      icon: 'error',
      title: 'Error al reservar',
      text: 'Ocurrió un error al registrar tu reserva. Intenta nuevamente.',
      confirmButtonColor: '#dc3545',
      background: isDark ? '#2c2c2c' : '#fff',
      color: isDark ? '#f5f5f5' : '#212529'
    });
  <?php endif; ?>
});
</script>
<?php endif; ?>

<script>
document.getElementById('nombre_salon').addEventListener('change', function() {
    const idEspacio = this.value;
    const recursosContainer = document.getElementById('recursos-container');
    const recursosList = document.getElementById('recursos-list');
    
    if (idEspacio) {
        // Hacer petición AJAX para obtener recursos
        fetch(`../funciones/obtener_recursos.php?id_espacio=${idEspacio}`)
            .then(response => response.json())
            .then(data => {
                recursosList.innerHTML = ''; // Limpiar lista anterior
                if (data.length > 0) {
                    data.forEach(recurso => {
                        const checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.name = 'recursos[]';
                        checkbox.value = recurso.id_recurso;
                        checkbox.id = `recurso-${recurso.id_recurso}`;
                        
                        const label = document.createElement('label');
                        label.htmlFor = `recurso-${recurso.id_recurso}`;
                        label.textContent = recurso.nombre_recurso;
                        
                        const div = document.createElement('div');
                        div.appendChild(checkbox);
                        div.appendChild(label);
                        recursosList.appendChild(div);
                    });
                    recursosContainer.style.display = 'block'; // Mostrar sección
                } else {
                    recursosContainer.style.display = 'none'; // Ocultar si no hay recursos
                }
            })
            .catch(error => console.error('Error al cargar recursos:', error));
    } else {
        recursosContainer.style.display = 'none';
    }
});
</script>

</body>
</html>