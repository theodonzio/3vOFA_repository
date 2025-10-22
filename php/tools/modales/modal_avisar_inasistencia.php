<!-- Modal Avisar Inasistencia -->
<div class="modal fade" id="avisarInasistenciaModal" tabindex="-1" aria-labelledby="avisarInasistenciaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="../funciones/registrar_inasistencia.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="avisarInasistenciaLabel">
            <i class="bi bi-exclamation-triangle-fill me-2 text-warning"></i>
            <span data-traducible="Avisar Inasistencia">Avisar Inasistencia</span>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>
            <small>Utiliza este formulario para notificar tu ausencia con anticipación</small>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold" data-traducible="Fecha de Inasistencia">
              <i class="bi bi-calendar-x me-1"></i>Fecha de Inasistencia
            </label>
            <input type="date" name="fecha_inasistencia" class="form-control" required 
                   min="<?php echo date('Y-m-d'); ?>">
            <small class="text-muted">Solo puedes seleccionar fechas futuras</small>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold" data-traducible="Motivo (opcional)">
              <i class="bi bi-chat-left-text me-1"></i>Motivo (opcional)
            </label>
            <textarea name="motivo" class="form-control" rows="4" 
                      placeholder="Describe brevemente el motivo de tu inasistencia..."
                      data-traducible="Describe brevemente el motivo de tu inasistencia..."></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-traducible="Cancelar">
            Cancelar
          </button>
          <button type="submit" class="btn btn-warning" data-traducible="Enviar Aviso">
            <i class="bi bi-send-fill me-2"></i>Enviar Aviso
          </button>
        </div>
      </form>
    </div>
  </div>
</div>