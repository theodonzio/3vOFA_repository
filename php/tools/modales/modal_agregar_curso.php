<!-- Modal Agregar Curso -->
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
            <div class="d-flex justify-content-between align-items-center mb-2">
              <label class="form-label fw-semibold mb-0" data-traducible="Seleccionar Horarios del Curso">
                Seleccionar Horarios del Curso
              </label>
              <div class="btn-group btn-group-sm" role="group">
                <button type="button" class="btn btn-outline-primary" id="btnSeleccionarTodos">
                  <i class="bi bi-check-all"></i> Seleccionar todos
                </button>
                <button type="button" class="btn btn-outline-secondary" id="btnDeseleccionarTodos">
                  <i class="bi bi-x-lg"></i> Deseleccionar todos
                </button>
                <button type="button" class="btn btn-outline-danger" id="btnEliminarSeleccionados">
                  <i class="bi bi-trash"></i> Eliminar seleccionados
                </button>
              </div>
            </div>
            <small class="d-block text-muted mb-2">Marcá los horarios en los que se dictará este curso</small>
            
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
                echo '<p class="text-muted text-center">No hay horarios disponibles. Por favor, crea horarios primero.</p>';
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

<!-- Script para funcionalidad del modal -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Seleccionar todos los horarios
  document.getElementById('btnSeleccionarTodos')?.addEventListener('click', function() {
    document.querySelectorAll('.checkbox-horario').forEach(cb => {
      cb.checked = true;
    });
    
    Swal.fire({
      icon: 'success',
      title: 'Todos seleccionados',
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 1500
    });
  });

  // Deseleccionar todos los horarios
  document.getElementById('btnDeseleccionarTodos')?.addEventListener('click', function() {
    document.querySelectorAll('.checkbox-horario').forEach(cb => {
      cb.checked = false;
    });
    
    Swal.fire({
      icon: 'info',
      title: 'Todos deseleccionados',
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 1500
    });
  });

  // Eliminar horarios seleccionados
  document.getElementById('btnEliminarSeleccionados')?.addEventListener('click', async function() {
    const seleccionados = Array.from(document.querySelectorAll('.checkbox-horario:checked'))
      .map(cb => parseInt(cb.value));

    if (seleccionados.length === 0) {
      Swal.fire({
        icon: 'warning',
        title: 'No hay horarios seleccionados',
        text: 'Selecciona al menos un horario para eliminar',
        confirmButtonColor: '#ffc107'
      });
      return;
    }

    const result = await Swal.fire({
      title: '¿Eliminar horarios?',
      html: `Se eliminarán <strong>${seleccionados.length}</strong> horario(s) seleccionado(s).<br><br>
             <small class="text-danger">ADVERTENCIA: Esto afectará a todos los cursos que usen estos horarios.</small>`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
    });

    if (!result.isConfirmed) return;

    // Mostrar loading
    Swal.fire({
      title: 'Eliminando...',
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      }
    });

    try {
      const response = await fetch('../funciones/eliminar_horario.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ids: seleccionados})
      });

      const resultado = await response.json();

      Swal.fire({
        icon: resultado.icono || 'success',
        title: resultado.titulo || 'Eliminado',
        text: resultado.mensaje || 'Horarios eliminados correctamente',
        confirmButtonColor: resultado.icono === 'success' ? '#198754' : '#dc3545'
      }).then(() => {
        if (resultado.icono === 'success') {
          location.reload();
        }
      });

    } catch (error) {
      console.error('Error:', error);
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'No se pudieron eliminar los horarios',
        confirmButtonColor: '#dc3545'
      });
    }
  });

  // Editar horario individual
  document.querySelectorAll('.btn-editar-horario').forEach(btn => {
    btn.addEventListener('click', async function(e) {
      e.preventDefault();
      e.stopPropagation();

      const id = this.dataset.id;
      const nombre = this.dataset.nombre;
      const inicio = this.dataset.inicio;
      const fin = this.dataset.fin;

      const { value: formValues } = await Swal.fire({
        title: 'Editar Horario',
        html: `
          <div class="mb-3 text-start">
            <label class="form-label fw-semibold">Nombre del horario</label>
            <input type="text" id="swal-nombre" class="form-control" value="${nombre}">
          </div>
          <div class="mb-3 text-start">
            <label class="form-label fw-semibold">Hora de inicio</label>
            <input type="time" id="swal-inicio" class="form-control" value="${inicio}">
          </div>
          <div class="mb-3 text-start">
            <label class="form-label fw-semibold">Hora de fin</label>
            <input type="time" id="swal-fin" class="form-control" value="${fin}">
          </div>
        `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Guardar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#198754',
        preConfirm: () => {
          return {
            id_horario: id,
            nombre_horario: document.getElementById('swal-nombre').value,
            hora_inicio: document.getElementById('swal-inicio').value,
            hora_fin: document.getElementById('swal-fin').value
          }
        }
      });

      if (formValues) {
        // Mostrar loading
        Swal.fire({
          title: 'Guardando...',
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
          }
        });

        try {
          const formData = new FormData();
          formData.append('id_horario', formValues.id_horario);
          formData.append('nombre_horario', formValues.nombre_horario);
          formData.append('hora_inicio', formValues.hora_inicio);
          formData.append('hora_fin', formValues.hora_fin);

          const response = await fetch('../funciones/editar_horario.php', {
            method: 'POST',
            body: formData
          });

          Swal.fire({
            icon: 'success',
            title: 'Guardado',
            text: 'Horario actualizado correctamente',
            confirmButtonColor: '#198754'
          }).then(() => {
            location.reload();
          });

        } catch (error) {
          console.error('Error:', error);
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo actualizar el horario',
            confirmButtonColor: '#dc3545'
          });
        }
      }
    });
  });
});
</script>
  