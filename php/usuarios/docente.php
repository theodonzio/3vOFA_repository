<?php
  session_start();
  include '../tools/head.php';
  include '../tools/header_docente.php';
  include '../login/conexion_bd.php';
  $id_docente = $_SESSION['id_usuario'];
?>

<!-- Título Superior -->
<div class="text-center titulo-adscripta">
  <img src="../../img/ofalogos/blue-logo.png" class="tinylogo"> 
    <img src="../../img/blueicons/docenteblue.png" class="blue_icon"> 
  <h1 class="display-4 fw-bold text-primary">Sistema de Gestión</h1>
  <p class="lead text-muted">Panel exclusivo para Docentes</p>

    <?php
  include '../tools/reloj.php';
  ?>
</div>

<!-- Hero Docente estilizado con imagen de fondo -->
<div class="hero hero-docente text-white d-flex align-items-center justify-content-center py-5"
  style="
    background-image: url('https://images.unsplash.com/photo-1604134967494-8a9ed3adea0d?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
    background-size: cover;
    background-position: center;
    position: relative;
    min-height: 420px;
  "
>

  <!-- Overlay semitransparente -->
  <div class="overlay" 
    style="
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(2px);
      border-radius: 20px;
    "
  ></div>

  <!-- Contenido del Hero -->
  <div class="container text-center hero-content" style="position: relative; z-index: 1;">
    <h2 class="display-6 fw-semibold mb-3">Sistema de Reservas</h2>
    <p class="mb-4 fs-5">Desde aquí podés solicitar espacios</p>

    <div class="d-flex justify-content-center gap-3">
      <button class="btn btn-success btn-lg shadow-sm btn_wicon" data-bs-toggle="modal" data-bs-target="#realizarReservaModal"><i class="bi bi-bookmark-fill"></i>
        Realizar Reserva
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
          <h5 class="modal-title" id="realizarReservaLabel">Realizar Reserva</h5>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label">Selecciona un Espacio</label>
            <select name="id_espacio" id="nombre_salon" class="form-select" required>
              <option value="">Seleccione un salón</option>
              <?php
              $sql = "SELECT id_espacio, nombre_espacio, tipo FROM espacio ORDER BY nombre_espacio ASC";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      echo "<option value='".$row['id_espacio']."'>".$row['nombre_espacio']." (".$row['tipo'].")</option>";
                  }
              }
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Fecha</label>
            <input type="date" name="fecha_reserva" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Horario</label>
            <select name="id_horario" class="form-select" required>
              <option value="">Seleccione un horario</option>
              <?php
              $sql = "SELECT id_horario, nombre_horario, hora_inicio, hora_fin FROM horario ORDER BY id_horario ASC";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      echo "<option value='".$row['id_horario']."'>".$row['nombre_horario']." (".$row['hora_inicio']." - ".$row['hora_fin'].")</option>";
                  }
              }
              ?>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success submit_btn">Reservar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="padre_tabla">
<!-- Tabla de Reservas -->
<div class="container" id="tabla_reservas_docente">
  <h3 id="title_reservasdocente">Mis Reservas</h3>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Salón</th>
        <th>Tipo</th>
        <th>Fecha</th>
        <th>Horario</th>
        <th>Docente</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT r.id_reserva, e.nombre_espacio, e.tipo AS tipo_salon, 
                     DATE(r.fecha_inicio) AS fecha, 
                     TIME(r.fecha_inicio) AS hora_inicio, TIME(r.fecha_fin) AS hora_fin, 
                     u.nombre AS nombre_docente, u.apellido AS apellido_docente,
                     r.estado
              FROM reserva r
              JOIN espacio e ON r.id_espacio = e.id_espacio
              JOIN usuario u ON r.id_docente = u.id_usuario
              WHERE r.id_docente = ?
              ORDER BY r.fecha_inicio ASC";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id_docente);
      $stmt->execute();
      $result = $stmt->get_result();
      while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>{$row['nombre_espacio']}</td>
                  <td>{$row['tipo_salon']}</td>
                  <td>{$row['fecha']}</td>
                  <td>{$row['hora_inicio']} - {$row['hora_fin']}</td>
                  <td>{$row['nombre_docente']} {$row['apellido_docente']}</td>
                  <td>{$row['estado']}</td>
                </tr>";
      }
      $stmt->close();
      $conn->close();
      ?>
    </tbody>
  </table>
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
