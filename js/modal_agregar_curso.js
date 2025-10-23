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