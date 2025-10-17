<link rel="stylesheet" href="../../css/style.css">

<div class="botones">
  <!-- Botón unificado: Docente / Adscripto -->
  <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalLogin" data-role="docente_adscripto">
    <img src="../img/icons/faceid_icon.png" class="indexlogo">
    <span data-traducible="Docente / Adscripto">Personal</span>
  </button>

  <!-- Botón Estudiante -->
  <button id="btnEstudiante" type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#modalEstudiante">
    <img src="../img/icons/student_icon.png" class="indexlogo">
    <span data-traducible="Estudiante">Estudiante</span>
  </button>
</div>

<!-- Modal Login -->
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLoginLabel" data-traducible="Acceso de Usuarios">Acceso de Usuarios</h5>
      </div>
      <div class="modal-body">
        <form id="formLogin" method="POST" action="../php/login/validar_login.php">
          <div class="mb-3">
            <label for="usuario" class="form-label" data-traducible="C.I - Email">C.I - Email</label>
            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="email@gmail.com" required>
          </div>
          <div class="mb-3">
            <label for="contrasena" class="form-label" data-traducible="Contraseña">Contraseña</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="•••••••••" required>
          </div>
          <input type="hidden" id="rol" name="rol">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-traducible="Cancelar">Cancelar</button>
        <button type="submit" form="formLogin" class="btn btn-primary" id="btnLogin" data-traducible="Ingresar">Ingresar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Estudiante -->
<div class="modal fade" id="modalEstudiante" tabindex="-1" aria-labelledby="modalEstudianteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEstudianteLabel" data-traducible="Selecciona tu grupo">Selecciona tu grupo</h5>
      </div>
      <div class="modal-body">
        <form id="formEstudiante" action="../php/usuarios/estudiante.php" method="GET">
          <div class="mb-3">
            <label for="opcionEstudiante" class="form-label" data-traducible="Elige tu grupo">Elige tu grupo</label>
            <select class="form-select" id="opcionEstudiante" name="id_grupo" required>
              <option value="" selected disabled>-- Seleccionar grupo --</option>
              <?php
              // Incluir conexión si no está definida
              if (!isset($conn)) {
                include '../php/login/conexion_bd.php';
              }
              
              // Consulta para obtener grupos
              $sql_grupos = "SELECT g.id_grupo, g.nombre_grupo, c.nombre_curso, t.nombre_turno
                             FROM grupo g
                             LEFT JOIN curso c ON g.id_curso = c.id_curso
                             LEFT JOIN turno t ON g.id_turno = t.id_turno
                             ORDER BY g.anio_curso, g.nombre_grupo";
              
              $result_grupos = $conn->query($sql_grupos);
              
              if ($result_grupos && $result_grupos->num_rows > 0) {
                while ($grupo = $result_grupos->fetch_assoc()) {
                  $nombre_completo = htmlspecialchars($grupo['nombre_grupo']);
                  if ($grupo['nombre_curso']) {
                    $nombre_completo .= " - " . htmlspecialchars($grupo['nombre_curso']);
                  }
                  if ($grupo['nombre_turno']) {
                    $nombre_completo .= " (" . htmlspecialchars($grupo['nombre_turno']) . ")";
                  }
                  echo "<option value='" . $grupo['id_grupo'] . "'>" . $nombre_completo . "</option>";
                }
              } else {
                echo "<option value='' disabled>No hay grupos disponibles</option>";
              }
              ?>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-traducible="Cancelar">Cancelar</button>
        <button type="submit" form="formEstudiante" class="btn btn-success" data-traducible="Continuar">Continuar</button>
      </div>
    </div>
  </div>
</div>