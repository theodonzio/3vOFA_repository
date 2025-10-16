<!-- Modal Agregar Curso -->
<div class="modal fade" id="agregarCursoModal" tabindex="-1" aria-labelledby="agregarCursoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content shadow border-0 rounded-3">
      <form action="../funciones/agregar_curso.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title fw-semibold" id="agregarCursoLabel">
            <span data-traducible="Agregar Curso">Agregar Curso</span>
          </h5>
        </div>

        <div class="modal-body p-4">
          <!-- Nombre del curso -->
          <div class="mb-3">
            <label class="form-label fw-semibold" data-traducible="Nombre del Curso">Nombre del Curso</label>
            <input type="text" name="nombre_curso" class="form-control" placeholder="Ej: Técnico en Informática" required>
          </div>

          <!-- Descripción -->
          <div class="mb-3">
            <label class="form-label fw-semibold" data-traducible="Descripción">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="2" placeholder="Descripción del curso"></textarea>
          </div>

          <!-- Duración -->
          <div class="mb-3">
            <label class="form-label fw-semibold" data-traducible="Duración en años">Duración en años</label>
            <input type="number" name="duracion_anos" class="form-control" min="1" max="10" placeholder="Ej: 3" required>
          </div>

          <!-- Selección de horarios -->
          <div class="mb-3">
            <label class="form-label fw-semibold" data-traducible="Seleccionar Horarios del Curso">Seleccionar Horarios del Curso</label>
            <small class="d-block text-muted mb-2">Marcá los horarios en los que se dictará este curso</small>
            <div id="listaHorarios" class="p-3 border rounded bg-light" style="max-height: 250px; overflow-y: auto;">
              <?php
              if (!isset($conn)) {
                include '../login/conexion_bd.php';
              }
              $query = "SELECT id_horario, nombre_horario, hora_inicio, hora_fin FROM horario ORDER BY id_horario";
              $result = $conn->query($query);
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="form-check mb-2">
                  <input class="form-check-input checkbox-horario" type="checkbox" name="id_horarios[]" value="'.$row['id_horario'].'" id="horario'.$row['id_horario'].'">
                  <label class="form-check-label" for="horario'.$row['id_horario'].'">
                    <strong>'.$row['nombre_horario'].'</strong>
                    <small class="text-muted"> ('.$row['hora_inicio'].' - '.$row['hora_fin'].')</small>
                  </label>
                </div>';
              }
              ?>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-traducible="Cancelar">Cancelar</button>
          <button type="submit" class="btn btn-success" data-traducible="Guardar Curso">Guardar Curso</button>
        </div>
      </form>
    </div>
  </div>
</div>