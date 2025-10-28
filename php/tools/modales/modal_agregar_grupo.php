<div class="modal fade" id="agregarGrupoModal" tabindex="-1" aria-labelledby="agregarGrupoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow border-0 rounded-3">
      <form action="../funciones/agregar_grupo.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title fw-semibold" id="agregarGrupoLabel">
            <span data-traducible="Agregar Grupo">Agregar Grupo</span>
          </h5>
        </div>

        <div class="modal-body p-4">
          <div class="mb-3">
            <label class="form-label fw-semibold" data-traducible="Nombre del Grupo">Nombre del Grupo</label>
            <input type="text" name="nombre_grupo" class="form-control" placeholder="Ej: 1A" required>
            <small class="text-muted">Ejemplo: 1A, 2B, 3MD</small>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold" data-traducible="Año del Curso">Año del Curso</label>
            <input type="number" name="anio_curso" class="form-control" placeholder="Ej: 1" required min="1" max="6">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold" data-traducible="Curso">Curso</label>
            <select name="id_curso" class="form-select" required>
              <option value="">Seleccionar curso...</option>
              <?php
              if (!isset($conn)) {
                include '../login/conexion_bd.php';
              }
              $cursos = $conn->query("SELECT id_curso, nombre_curso FROM curso ORDER BY nombre_curso");
              while ($c = $cursos->fetch_assoc()) {
                echo "<option value='{$c['id_curso']}'>{$c['nombre_curso']}</option>";
              }
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold" data-traducible="Turno">Turno</label>
            <select name="id_turno" class="form-select" required>
              <option value="">Seleccionar turno...</option>
              <?php
              $turnos = $conn->query("SELECT id_turno, nombre_turno FROM turno ORDER BY id_turno");
              while ($t = $turnos->fetch_assoc()) {
                echo "<option value='{$t['id_turno']}'>{$t['nombre_turno']}</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-traducible="Cancelar">Cancelar</button>
          <button type="submit" class="btn btn-success" data-traducible="Guardar">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>