<?php
  include '../tools/head.php';
  include '../tools/header_adscripta.php';
?>
<body class="<?php echo isset($_SESSION['modoOscuro']) && $_SESSION['modoOscuro'] ? 'oscuro' : ''; ?>">
<!-- Título Superior -->
<div class="text-center titulo-adscripta">
  <img src="../../img/ofalogos/blue-logo.png" class="tinylogo"> 
    <img src="../../img/blueicons/adscriptablue.png" class="blue_icon"> 
  <h1 class="display-4 fw-bold text-primary">Sistema de Gestión</h1>
  <p class="lead text-muted">Panel exclusivo para Adscripta</p>
</div>

<!-- Hero Section con imagen de fondo -->
<div class="hero text-white py-5 d-flex align-items-center justify-content-center" style="background-image: url('https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover; background-position: center; position: relative; min-height: 400px;">
  
  <!-- Overlay para mejorar legibilidad del texto -->
  <div style="position: absolute; top:0; left:0; right:0; bottom:0; background: rgba(0,0,0,0.4); border-radius: 20px"></div>

  <div class="container text-center" style="position: relative; z-index: 1;">

    <h2 class="display-6 fw-semibold">Docentes del Sistema</h2>
    <p class="mb-4">Desde aquí puedes gestionar a los docentes registrados en el sistema</p>

    <!-- Botones juntos -->
    <div class="d-flex justify-content-center gap-3">
      <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#registrarDocenteModal">
        Registrar Docente
      </button>
      <a href="../PaginasAdcriptas/docentes.php" class="btn btn-outline-light btn-lg">
        Ver Docentes
      </a>
    </div>

  </div>
</div>


<!-- Modal Registrar Docente -->
<div class="modal fade" id="registrarDocenteModal" tabindex="-1" aria-labelledby="registrarDocenteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="../funciones/registrar_docente.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="registrarDocenteLabel">Registrar Docente</h5>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
          </div>
          <div class="mb-3">
            <input type="text" name="apellido" class="form-control" placeholder="Apellido" required>
          </div>
          <div class="mb-3">
            <input type="text" name="cedula" class="form-control" placeholder="Cédula" required>
          </div>
          <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
          </div>
          <div class="mb-3">
            <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" required>
          </div>
          <input type="hidden" name="id_rol" value="2"> <!-- Rol docente -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>



<!-- Hero Espacios -->
<div class="hero text-white py-5 d-flex align-items-center justify-content-center"
  style="background-image: url('https://images.unsplash.com/photo-1604134967494-8a9ed3adea0d?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); 
         background-size: cover; 
         background-position: center; 
         position: relative; 
         min-height: 400px;">

  <!-- Capa oscura -->
  <div style="position: absolute; top:0; left:0; right:0; bottom:0; background: rgba(0,0,0,0.4); border-radius: 20px"></div>

  <!-- Contenido del Hero -->
  <div class="container text-center" style="position: relative; z-index: 1;">

    <h2 data-traducible="Gestión de Espacios" class="display-6 fw-semibold">
      Gestión de Espacios
    </h2>
    <p data-traducible="Desde aquí podés agregar nuevos espacios al sistema y asignarles recursos" class="mb-4">
      Desde aquí podés agregar nuevos espacios al sistema y asignarles recursos
    </p>

    <div class="d-flex justify-content-center gap-3">
      <button data-traducible="Agregar Espacio" class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#agregarEspacioModal">Agregar Espacio</button>
    </div>

  </div>
</div>

<!-- Modal Agregar Espacio -->
<div class="modal fade" id="agregarEspacioModal" tabindex="-1" aria-labelledby="agregarEspacioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="../funciones/agregar_espacio.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="agregarEspacioLabel">Agregar Espacio</h5>
        </div>

        <div class="modal-body">
          <!-- Tipo de salón -->
          <div class="mb-3">
            <label class="form-label">Tipo de Salón</label>
            <select name="tipo_salon" class="form-select" required>
              <option value="">Seleccione un tipo</option>
              <option value="Aula">Aula</option>
              <option value="Laboratorio">Laboratorio</option>
              <option value="Salón">Salón</option>
              <option value="SUM">SUM</option>
            </select>
          </div>

          <!-- Descripción del salón -->
          <div class="mb-3">
            <label class="form-label">Descripción o nombre del espacio</label>
            <input type="text" name="descripcion" class="form-control" placeholder="Ej: Laboratorio de Informática 2" required>
          </div>

          <!-- Recursos -->
          <label>Selecciona los recursos que contiene:</label><br>
          <div class="recursos">
            <input type="checkbox" id="television" name="opciones[]" value="Televisión">
            <label for="television"><img src="../../img/icons/tv_icon.png" class="icono">Televisión</label><br>
            <input type="checkbox" id="cableHDMI" name="opciones[]" value="Cable HDMI">
            <label for="cableHDMI"><img src="../../img/icons/hdmi_icon.png" class="icono">Cable HDMI</label><br>
            <input type="checkbox" id="aireAcondicionado" name="opciones[]" value="Aire Acondicionado">
            <label for="aireAcondicionado"><img src="../../img/icons/air_icon.png" class="icono">Aire Acondicionado</label><br>
            <input type="checkbox" id="proyector" name="opciones[]" value="Proyector">
            <label for="proyector"><img src="../../img/icons/proyector_icon.png" class="icono">Proyector</label><br>
            <input type="checkbox" id="alargue" name="opciones[]" value="Alargue">
            <label for="alargue"><img src="../../img/icons/alargue_icon.png" class="icono">Alargue</label><br>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Sección de Reservas -->
<div id="tabla_reservas_adscripta" class="container my-5">
    <h2 class="mb-4 text-center" id="title_reserva">Reservas de los Docentes</h2>
    <div class="row">
  <?php
  include '../login/conexion_bd.php';

  $sql = "SELECT r.id_reserva, e.nombre_espacio, e.tipo AS tipo_salon,
                 DATE(r.fecha_inicio) AS fecha,
                 TIME(r.fecha_inicio) AS hora_inicio,
                 TIME(r.fecha_fin) AS hora_fin,
                 u.nombre AS nombre_docente, u.apellido AS apellido_docente,
                 r.estado
          FROM reserva r
          JOIN espacio e ON r.id_espacio = e.id_espacio
          JOIN usuario u ON r.id_docente = u.id_usuario
          ORDER BY r.fecha_inicio DESC";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {

          $estado = $row['estado'];
          $colorEstado = 'secondary';
          $icono = 'question-circle';
          $textoColor = 'text-dark';

          // 🎨 Colores e íconos según estado
          if ($estado == 'Pendiente') {
              $colorEstado = 'warning';
              $icono = 'clock';
              $textoColor = 'text-warning';
          } elseif ($estado == 'Aprobada') {
              $colorEstado = 'success';
              $icono = 'check-circle';
              $textoColor = 'text-success';
          } elseif ($estado == 'No aprobada' || $estado == 'Rechazada' || $estado == 'Rechazado') {
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
                          <?php echo $row['nombre_docente'] . ' ' . $row['apellido_docente']; ?>
                      </h5>
                      <span class="badge bg-light <?php echo $textoColor; ?> fw-bold">
                          <?php echo strtoupper($estado); ?>
                      </span>
                  </div>

                  <div class="card-body">
                      <ul class="list-unstyled mb-3">
                          <li><strong>Salón:</strong> <?php echo $row['nombre_espacio'] . ' (' . $row['tipo_salon'] . ')'; ?></li>
                          <li><strong>Fecha:</strong> <?php echo $row['fecha']; ?></li>
                          <li><strong>Horario:</strong> <?php echo $row['hora_inicio'] . ' - ' . $row['hora_fin']; ?></li>
                      </ul>

                      <?php if($estado == 'Pendiente'){ ?>
                      <form action="../funciones/aprobar_reserva.php" method="POST" class="d-flex justify-content-between">
                          <input type="hidden" name="id_reserva" value="<?php echo $row['id_reserva']; ?>">
                          <button type="submit" name="accion" value="Aprobar" class="btn btn-success w-50 me-2">
                              <i class="bi bi-check-lg"></i> Aprobar
                          </button>
                          <button type="submit" name="accion" value="Rechazar" class="btn btn-danger w-50">
                              <i class="bi bi-x-lg"></i> No aprobar
                          </button>
                      </form>
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

  $conn->close();
  ?>
</div>
</div>

<?php
  include '../tools/footer.php';
?>

<!-- Bootstrap Bundle JS (incluye Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<!-- Inicialización de tooltips -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
  });
</script>

<!-- Scripts locales -->
<script src="../../js/modoClaroOscuro.js"></script>
<script src="../../js/traductor.js"></script>
</body>