<?php
  include '../tools/head.php';
  include '../tools/header_adscripta.php';
?>

<!-- Título Superior -->
<div class="text-center titulo-adscripta">
  <img src="../../img/ofalogos/blue-logo.png" class="tinylogo"> 
    <img src="../../img/blueicons/adscriptablue.png" class="blue_icon"> 
  <h1 class="display-4 fw-bold text-primary">Sistema de Gestión OFA</h1>
  <p class="lead text-muted">Panel exclusivo para Adscripta</p>
</div>

<!-- Hero Section con imagen de fondo -->
<div class="hero text-white py-5 d-flex align-items-center justify-content-center" style="background-image: url('https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover; background-position: center; position: relative; min-height: 400px;">
  
  <!-- Overlay para mejorar legibilidad del texto -->
  <div style="position: absolute; top:0; left:0; right:0; bottom:0; background: rgba(0,0,0,0.4);"></div>

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
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Apellido</label>
            <input type="text" name="apellido" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Cédula</label>
            <input type="text" name="cedula" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" name="contrasena" class="form-control" required>
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
<div class="hero-espacios">
  <div class="overlay"></div>
  <div class="container text-center hero-content">
    <h2>Gestión de Espacios</h2>
    <p>Desde aquí podés agregar nuevos espacios al sistema y asignarles recursos</p>
    <div class="d-flex justify-content-center gap-3">
      <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#agregarEspacioModal">
        ➕ Agregar Espacio
      </button>
    </div>
  </div>
</div>

<hr>

<!-- Modal Agregar Espacio -->
<div class="modal fade" id="agregarEspacioModal" tabindex="-1" aria-labelledby="agregarEspacioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="../funciones/agregar_espacio.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="agregarEspacioLabel">Agregar Espacio</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
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
          <div class="ms-3">
            <input type="checkbox" id="television" name="opciones[]" value="Televisión">
            <label for="television">Televisión</label><br>
            <input type="checkbox" id="cableHDMI" name="opciones[]" value="Cable HDMI">
            <label for="cableHDMI">Cable HDMI</label><br>
            <input type="checkbox" id="aireAcondicionado" name="opciones[]" value="Aire Acondicionado">
            <label for="aireAcondicionado">Aire Acondicionado</label><br>
            <input type="checkbox" id="proyector" name="opciones[]" value="Proyector">
            <label for="proyector">Proyector</label><br>
            <input type="checkbox" id="alargue" name="opciones[]" value="Alargue">
            <label for="alargue">Alargue</label><br>
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
<div class="container my-5">
    <h2 class="mb-4 text-center">Reservas Realizadas por los Docentes</h2>
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
                // Color según estado
                $color = ($row['estado'] == 'Pendiente') ? 'warning' : 'success';
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 border-<?php echo $color; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['nombre_docente'] . ' ' . $row['apellido_docente']; ?></h5>
                            <p class="card-text">
                                <strong>Salón:</strong> <?php echo $row['nombre_espacio'] . ' (' . $row['tipo_salon'] . ')'; ?><br>
                                <strong>Fecha:</strong> <?php echo $row['fecha']; ?><br>
                                <strong>Horario:</strong> <?php echo $row['hora_inicio'] . ' - ' . $row['hora_fin']; ?><br>
                                <strong>Estado:</strong> <?php echo $row['estado']; ?>
                            </p>

                            <?php if($row['estado'] == 'Pendiente'){ ?>
                            <form action="../funciones/aprobar_reserva.php" method="POST" class="d-flex gap-2">
                                <input type="hidden" name="id_reserva" value="<?php echo $row['id_reserva']; ?>">
                                <button type="submit" name="accion" value="Aprobar" class="btn btn-success btn-sm">Aprobar</button>
                                <button type="submit" name="accion" value="Rechazar" class="btn btn-danger btn-sm">No aprobar</button>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<div class="col-12"><p class="text-center">No hay reservas registradas aún.</p></div>';
        }

        $conn->close();
        ?>
    </div>
</div>