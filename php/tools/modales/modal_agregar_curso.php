<div class="modal fade" id="agregarCursoModal" tabindex="-1" aria-labelledby="agregarCursoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content shadow border-0 rounded-3">
      <form action="../funciones/agregar_curso.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title fw-semibold" id="agregarCursoLabel">
            <span data-traducible="Agregar Curso">Agregar Curso</span>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body p-4">
          <div class="mb-3">
            <label class="form-label fw-semibold" data-traducible="Nombre del Curso">Nombre del Curso</label>
            <input type="text" name="nombre_curso" class="form-control" placeholder="Ej: Técnico en Informática" data-traducible="Ej: Técnico en Informática" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold" data-traducible="Descripción">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="2" placeholder="Descripción del curso" data-traducible="Descripción del curso"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold" data-traducible="Duración en años">Duración en años</label>
            <input type="number" name="duracion_anos" class="form-control" min="1" max="10" placeholder="Ej: 3" data-traducible="Ej: 3" required>
          </div>

          <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <label class="form-label fw-semibold mb-0" data-traducible="Seleccionar Horarios del Curso">
                Seleccionar Horarios del Curso
              </label>
              <div class="btn-group btn-group-sm" role="group">
                <button type="button" class="btn btn-outline-primary" id="btnSeleccionarTodos">
                  <i class="bi bi-check-all"></i> <span data-traducible="Seleccionar todos">Seleccionar todos</span>
                </button>
                <button type="button" class="btn btn-outline-secondary" id="btnDeseleccionarTodos">
                  <i class="bi bi-x-lg"></i> <span data-traducible="Deseleccionar todos">Deseleccionar todos</span>
                </button>
                <button type="button" class="btn btn-outline-danger" id="btnEliminarSeleccionados">
                  <i class="bi bi-trash"></i> <span data-traducible="Eliminar seleccionados">Eliminar seleccionados</span>
                </button>
              </div>
            </div>
            <small class="d-block text-muted mb-2" data-traducible="Marcá los horarios en los que se dictará este curso">Marcá los horarios en los que se dictará este curso</small>
            
            <div id="listaHorarios" class="p-3 border rounded bg-light" style="max-height: 300px; overflow-y: auto;">
              <?php
              if (!isset($conn)) {
                include '../login/conexion_bd.php';
              }
              $query = "SELECT id_horario, nombre_horario, hora_inicio, hora_fin FROM horario ORDER BY hora_inicio";
              $result = $conn->query($query);
              
              if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '
                  <div class="form-check mb-2 horario-item">
                    <input class="form-check-input checkbox-horario" type="checkbox" name="id_horarios[]" 
                           value="'.$row['id_horario'].'" id="horario'.$row['id_horario'].'">
                    <label class="form-check-label w-100" for="horario'.$row['id_horario'].'">
                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                          <strong>'.$row['nombre_horario'].'</strong>
                          <small class="text-muted"> ('.$row['hora_inicio'].' - '.$row['hora_fin'].')</small>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary btn-editar-horario" 
                                data-id="'.$row['id_horario'].'"
                                data-nombre="'.$row['nombre_horario'].'"
                                data-inicio="'.$row['hora_inicio'].'"
                                data-fin="'.$row['hora_fin'].'">
                          <i class="bi bi-pencil"></i>
                        </button>
                      </div>
                    </label>
                  </div>';
                }
              } else {
                echo '<p class="text-muted text-center" data-traducible="No hay horarios disponibles. Por favor, crea horarios primero.">No hay horarios disponibles. Por favor, crea horarios primero.</p>';
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

<script src="../../js/modal_agregar_curso.js"></script>