<?php
  include '../tools/head.php';
  include '../tools/header_adscripta.php';
?>

<!-- Título Superior -->
<div class="text-center titulo-adscripta">
  <img src="../../img/ofalogos/blue-logo.png" class="tinylogo"> 
  <img src="../../img/blueicons/adscriptablue.png" class="blue_icon"> 
  <h1 data-traducible="Sistema de Gestión OFA" class="display-4 fw-bold text-primary">Sistema de Gestión OFA</h1>
  <p data-traducible="Panel exclusivo para Adscripta" class="lead text-muted">Panel exclusivo para Adscripta</p>
</div>

<!-- Hero Section con imagen de fondo -->
<div class="hero text-white py-5 d-flex align-items-center justify-content-center" style="background-image: url('https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover; background-position: center; position: relative; min-height: 400px;">
  
  <div style="position: absolute; top:0; left:0; right:0; bottom:0; background: rgba(0,0,0,0.4);"></div>

  <div class="container text-center" style="position: relative; z-index: 1;">

    <h2 data-traducible="Docentes del Sistema" class="display-6 fw-semibold">Docentes del Sistema</h2>
    <p data-traducible="Desde aquí puedes gestionar a los docentes registrados en el sistema" class="mb-4">Desde aquí puedes gestionar a los docentes registrados en el sistema</p>

    <!-- Botones juntos -->
    <div class="d-flex justify-content-center gap-3">
      <button data-traducible="Registrar Docente" class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#registrarDocenteModal">
        Registrar Docente
      </button>
      <a data-traducible="Ver Docentes" href="docentes.php" class="btn btn-outline-light btn-lg">
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
          <h5 data-traducible="Registrar Docente" class="modal-title" id="registrarDocenteLabel">Registrar Docente</h5>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label data-traducible="Nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
          </div>
          <div class="mb-3">
            <label data-traducible="Apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" class="form-control" required>
          </div>
          <div class="mb-3">
            <label data-traducible="Cédula" class="form-label">Cédula</label>
            <input type="text" name="cedula" class="form-control" required>
          </div>
          <div class="mb-3">
            <label data-traducible="Email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label data-traducible="Contraseña" class="form-label">Contraseña</label>
            <input type="password" name="contrasena" class="form-control" required>
          </div>
          <input type="hidden" name="id_rol" value="2">
        </div>
        <div class="modal-footer">
          <button data-traducible="Cancelar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button data-traducible="Guardar" type="submit" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Hero Espacios -->
<div class="hero text-white py-5 d-flex align-items-center justify-content-center"
  style="background-image: url('https://images.unsplash.com/photo-1635424239131-32dc44986b56?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); 
         background-size: cover; 
         background-position: center; 
         position: relative; 
         min-height: 400px;">

  <!-- Capa oscura -->
  <div style="position: absolute; top:0; left:0; right:0; bottom:0; background: rgba(0,0,0,0.4);"></div>

  <!-- Contenido del Hero -->
  <div class="container text-center" style="position: relative; z-index: 1;">

    <h2 data-traducible="Gestión de Espacios" class="display-6 fw-semibold">
      Gestión de Espacios
    </h2>
    <p data-traducible="Desde aquí podés agregar nuevos espacios al sistema y asignarles recursos" class="mb-4">
      Desde aquí podés agregar nuevos espacios al sistema y asignarles recursos
    </p>

    <div class="d-flex justify-content-center gap-3">
      <button data-traducible="➕ Agregar Espacio" class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#agregarEspacioModal">
        ➕ Agregar Espacio
      </button>
    </div>

  </div>
</div>


<!-- Modal Agregar Espacio -->
<div class="modal fade" id="agregarEspacioModal" tabindex="-1" aria-labelledby="agregarEspacioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="../funciones/agregar_espacio.php" method="POST">
        <div class="modal-header">
          <h5 data-traducible="Agregar Espacio" class="modal-title" id="agregarEspacioLabel">Agregar Espacio</h5>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label data-traducible="Tipo de Salón" class="form-label">Tipo de Salón</label>
            <select name="tipo_salon" class="form-select" required>
              <option data-traducible="Seleccione un tipo" value="">Seleccione un tipo</option>
              <option data-traducible="Aula" value="Aula">Aula</option>
              <option data-traducible="Laboratorio" value="Laboratorio">Laboratorio</option>
              <option data-traducible="Salón" value="Salón">Salón</option>
              <option data-traducible="SUM" value="SUM">SUM</option>
            </select>
          </div>

          <div class="mb-3">
            <label data-traducible="Descripción o nombre del espacio" class="form-label">Descripción o nombre del espacio</label>
            <input type="text" name="descripcion" class="form-control" placeholder="Ej: Laboratorio de Informática 2" required>
          </div>

          <label data-traducible="Selecciona los recursos que contiene:">Selecciona los recursos que contiene:</label><br>
          <div class="ms-3">
            <input type="checkbox" id="television" name="opciones[]" value="Televisión">
            <label data-traducible="Televisión" for="television">Televisión</label><br>
            <input type="checkbox" id="cableHDMI" name="opciones[]" value="Cable HDMI">
            <label data-traducible="Cable HDMI" for="cableHDMI">Cable HDMI</label><br>
            <input type="checkbox" id="aireAcondicionado" name="opciones[]" value="Aire Acondicionado">
            <label data-traducible="Aire Acondicionado" for="aireAcondicionado">Aire Acondicionado</label><br>
            <input type="checkbox" id="proyector" name="opciones[]" value="Proyector">
            <label data-traducible="Proyector" for="proyector">Proyector</label><br>
            <input type="checkbox" id="alargue" name="opciones[]" value="Alargue">
            <label data-traducible="Alargue" for="alargue">Alargue</label><br>
          </div>
        </div>

        <div class="modal-footer">
          <button data-traducible="Cancelar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button data-traducible="Guardar" type="submit" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Sección de Reservas -->
<div class="container my-5">
    <h2 data-traducible="Reservas Realizadas por los Docentes" class="mb-4 text-center">Reservas Realizadas por los Docentes</h2>
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
                $color = ($row['estado'] == 'Pendiente') ? 'warning' : 'success';
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 border-<?php echo $color; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['nombre_docente'] . ' ' . $row['apellido_docente']; ?></h5>
                            <p class="card-text">
                                <strong data-traducible="Salón:">Salón:</strong> <?php echo $row['nombre_espacio'] . ' (' . $row['tipo_salon'] . ')'; ?><br>
                                <strong data-traducible="Fecha:">Fecha:</strong> <?php echo $row['fecha']; ?><br>
                                <strong data-traducible="Horario:">Horario:</strong> <?php echo $row['hora_inicio'] . ' - ' . $row['hora_fin']; ?><br>
                                <strong data-traducible="Estado:">Estado:</strong> <?php echo $row['estado']; ?>
                            </p>

                            <?php if($row['estado'] == 'Pendiente'){ ?>
                            <form action="../funciones/aprobar_reserva.php" method="POST" class="d-flex gap-2">
                                <input type="hidden" name="id_reserva" value="<?php echo $row['id_reserva']; ?>">
                                <button type="submit" name="accion" value="Aprobar" data-traducible="Aprobar" class="btn btn-success btn-sm">Aprobar</button>
                                <button type="submit" name="accion" value="Rechazar" data-traducible="No aprobar" class="btn btn-danger btn-sm">No aprobar</button>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<div class="col-12"><p data-traducible="No hay reservas registradas aún." class="text-center">No hay reservas registradas aún.</p></div>';
        }

        $conn->close();
        ?>
    </div>
</div>
<script src="../../js/traductor.js"></script>
