<?php
  session_start();
  include '../tools/head.php';
  include '../tools/header_docente.php';
  include '../login/conexion_bd.php';
  $id_docente = $_SESSION['id_usuario'];
?>

<!-- Hero Docente -->
<div class="hero-docente">
  <div class="overlay"></div>
  <div class="container text-center hero-content">
    <h2>Bienvenido al Sistema de Reservas</h2>
    <p>Desde aquí podés realizar nuevas reservas</p>
    <div class="d-flex justify-content-center gap-3">
      <button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#realizarReservaModal">
        ➕ Realizar Reserva
      </button>
    </div>
  </div>
</div>

<hr>

<!-- Modal Realizar Reserva -->
<div class="modal fade" id="realizarReservaModal" tabindex="-1" aria-labelledby="realizarReservaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="../funciones/realizar_reserva.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="realizarReservaLabel">Realizar Reserva</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Tipo de Salón</label>
            <select name="tipo_salon" id="tipo_salon" class="form-select" required>
              <option value="">Seleccione un tipo</option>
              <option value="Aula">Aula</option>
              <option value="Laboratorio">Laboratorio</option>
              <option value="Salón">Salón</option>
              <option value="SUM">SUM</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Nombre del Salón</label>
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
          <button type="submit" class="btn btn-success">Reservar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<hr>

<!-- Tabla de Reservas -->
<div class="container my-4">
  <h3>Mis Reservas</h3>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>