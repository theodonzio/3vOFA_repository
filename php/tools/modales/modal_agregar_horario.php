<div class="modal fade" id="agregarHorarioModal" tabindex="-1" aria-labelledby="agregarHorarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="../funciones/agregar_horario.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="agregarHorarioLabel" data-traducible="Agregar Horario">Agregar Horario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label" data-traducible="Nombre del horario">Nombre del horario</label>
            <input type="text" name="nombre_horario" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label" data-traducible="Hora de inicio">Hora de inicio</label>
            <input type="time" name="hora_inicio" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label" data-traducible="Hora de fin">Hora de fin</label>
            <input type="time" name="hora_fin" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" data-traducible="Guardar">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>