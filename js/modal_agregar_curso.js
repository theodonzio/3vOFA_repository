document.addEventListener('DOMContentLoaded', function() {
  // Selecciona todos los horarios
  document.getElementById('btnSeleccionarTodos')?.addEventListener('click', function() {
    document.querySelectorAll('.checkbox-horario').forEach(cb => {
      cb.checked = true;
    });
    
    Swal.fire({
      icon: 'success',
      title: obtenerTraduccion('Todos seleccionados'),
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 1500
    });
  });

  // Deselecciona todos los horarios
  document.getElementById('btnDeseleccionarTodos')?.addEventListener('click', function() {
    document.querySelectorAll('.checkbox-horario').forEach(cb => {
      cb.checked = false;
    });
    
    Swal.fire({
      icon: 'info',
      title: obtenerTraduccion('Todos deseleccionados'),
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 1500
    });
  });

  // Elimina horarios seleccionados
  document.getElementById('btnEliminarSeleccionados')?.addEventListener('click', async function() {
    const seleccionados = Array.from(document.querySelectorAll('.checkbox-horario:checked'))
      .map(cb => parseInt(cb.value));

    if (seleccionados.length === 0) {
      Swal.fire({
        icon: 'warning',
        title: obtenerTraduccion('No hay horarios seleccionados'),
        text: obtenerTraduccion('Selecciona al menos un horario para eliminar'),
        confirmButtonColor: '#ffc107'
      });
      return;
    }

    const result = await Swal.fire({
      title: obtenerTraduccion('¿Eliminar horarios?'),
      html: `${obtenerTraduccion('Se eliminarán')} <strong>${seleccionados.length}</strong> ${obtenerTraduccion('horario(s) seleccionado(s)')}.<br><br>
             <small class="text-danger">${obtenerTraduccion('ADVERTENCIA: Esto afectará a todos los cursos que usen estos horarios.')}</small>`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: obtenerTraduccion('Sí, eliminar'),
      cancelButtonText: obtenerTraduccion('Cancelar')
    });

    if (!result.isConfirmed) return;

    // Muestra loading
    Swal.fire({
      title: obtenerTraduccion('Eliminando...'),
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
        title: obtenerTraduccion(resultado.titulo || 'Eliminado'),
        text: obtenerTraduccion(resultado.mensaje || 'Horarios eliminados correctamente'),
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
        title: obtenerTraduccion('Error'),
        text: obtenerTraduccion('No se pudieron eliminar los horarios'),
        confirmButtonColor: '#dc3545'
      });
    }
  });

  // Edita horario individual
  document.querySelectorAll('.btn-editar-horario').forEach(btn => {
    btn.addEventListener('click', async function(e) {
      e.preventDefault();
      e.stopPropagation();

      const id = this.dataset.id;
      const nombre = this.dataset.nombre;
      const inicio = this.dataset.inicio;
      const fin = this.dataset.fin;

      // Cerrar el modal de Bootstrap antes de abrir SweetAlert
      const modalBootstrap = bootstrap.Modal.getInstance(document.getElementById('agregarCursoModal'));
      if (modalBootstrap) {
        modalBootstrap.hide();
      }

      // Esperar un poco para que el modal se cierre completamente
      await new Promise(resolve => setTimeout(resolve, 300));

      const { value: formValues } = await Swal.fire({
        title: obtenerTraduccion('Editar Horario'),
        html: `
          <div class="mb-3 text-start">
            <label class="form-label fw-semibold">${obtenerTraduccion('Nombre del horario')}</label>
            <input type="text" id="swal-nombre" class="form-control" value="${nombre}">
          </div>
          <div class="mb-3 text-start">
            <label class="form-label fw-semibold">${obtenerTraduccion('Hora de inicio')}</label>
            <input type="time" id="swal-inicio" class="form-control" value="${inicio}">
          </div>
          <div class="mb-3 text-start">
            <label class="form-label fw-semibold">${obtenerTraduccion('Hora de fin')}</label>
            <input type="time" id="swal-fin" class="form-control" value="${fin}">
          </div>
        `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: obtenerTraduccion('Guardar'),
        cancelButtonText: obtenerTraduccion('Cancelar'),
        confirmButtonColor: '#198754',
        cancelButtonColor: '#6c757d',
        didOpen: () => {
          // Asegurar que el input pueda recibir focus
          const inputNombre = document.getElementById('swal-nombre');
          if (inputNombre) {
            setTimeout(() => {
              inputNombre.focus();
              inputNombre.select();
            }, 100);
          }
        },
        preConfirm: () => {
          const nombreInput = document.getElementById('swal-nombre').value.trim();
          const inicioInput = document.getElementById('swal-inicio').value;
          const finInput = document.getElementById('swal-fin').value;

          // Validaciones
          if (!nombreInput) {
            Swal.showValidationMessage(obtenerTraduccion('El nombre del horario es obligatorio'));
            return false;
          }
          if (!inicioInput || !finInput) {
            Swal.showValidationMessage(obtenerTraduccion('Las horas de inicio y fin son obligatorias'));
            return false;
          }

          return {
            id_horario: id,
            nombre_horario: nombreInput,
            hora_inicio: inicioInput,
            hora_fin: finInput
          }
        }
      });

      if (formValues) {
        // Muestra loading
        Swal.fire({
          title: obtenerTraduccion('Guardando...'),
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

          // Verificar si la respuesta es JSON
          const contentType = response.headers.get('content-type');
          let resultado;

          if (contentType && contentType.includes('application/json')) {
            resultado = await response.json();
            
            if (resultado.success) {
              Swal.fire({
                icon: 'success',
                title: obtenerTraduccion('Guardado'),
                text: obtenerTraduccion(resultado.mensaje || 'Horario actualizado correctamente'),
                confirmButtonColor: '#198754'
              }).then(() => {
                location.reload();
              });
            } else {
              throw new Error(resultado.error || obtenerTraduccion('Error al actualizar el horario'));
            }
          } else {
            // Si no es JSON, asumir que es una redirección exitosa (código antiguo)
            Swal.fire({
              icon: 'success',
              title: obtenerTraduccion('Guardado'),
              text: obtenerTraduccion('Horario actualizado correctamente'),
              confirmButtonColor: '#198754'
            }).then(() => {
              location.reload();
            });
          }

        } catch (error) {
          console.error('Error:', error);
          Swal.fire({
            icon: 'error',
            title: obtenerTraduccion('Error'),
            text: error.message || obtenerTraduccion('No se pudo actualizar el horario'),
            confirmButtonColor: '#dc3545'
          });
        }
      } else {
        // Si se canceló, volver a abrir el modal de Bootstrap
        const modalElement = document.getElementById('agregarCursoModal');
        if (modalElement) {
          const modalBootstrap = new bootstrap.Modal(modalElement);
          modalBootstrap.show();
        }
      }
    });
  });
});