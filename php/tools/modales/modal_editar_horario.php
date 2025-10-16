<!-- Modal Editar Horario -->
<div class="modal fade" id="editarHorarioModal" tabindex="-1" aria-labelledby="editarHorarioLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../funciones/editar_horario.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="editarHorarioLabel" data-traducible="Editar Horario">Editar Horario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_horario" id="edit_id_horario">
          <div class="mb-3">
            <label class="form-label" data-traducible="Nombre del horario">Nombre del horario</label>
            <input type="text" name="nombre_horario" id="edit_nombre_horario" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label" data-traducible="Hora de inicio">Hora de inicio</label>
            <input type="time" name="hora_inicio" id="edit_hora_inicio" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label" data-traducible="Hora de fin">Hora de fin</label>
            <input type="time" name="hora_fin" id="edit_hora_fin" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" data-traducible="Actualizar">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>