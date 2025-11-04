// Confirmación de eliminación de recursos
document.addEventListener('DOMContentLoaded', function() {
    const botonesEliminar = document.querySelectorAll('.btn-eliminar');
    
    botonesEliminar.forEach(boton => {
        boton.addEventListener('click', function(e) {
            const nombreRecurso = this.getAttribute('data-nombre');
            const confirmar = confirm(`¿Seguro que deseas eliminar el recurso ${nombreRecurso}?`);
            
            if (!confirmar) {
                e.preventDefault();
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
  const isDarkMode = document.body.classList.contains('oscuro');

  document.querySelectorAll('.eliminar-recurso').forEach(boton => {
    boton.addEventListener('click', (e) => {
      e.preventDefault();
      const id = boton.dataset.id;
      const nombre = boton.dataset.nombre;

      Swal.fire({
        title: obtenerTraduccion('¿Eliminar recurso?'),
        text: `${obtenerTraduccion('Se eliminará el recurso')} "${nombre}" ${obtenerTraduccion('del sistema')}.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: obtenerTraduccion('Sí, eliminar'),
        cancelButtonText: obtenerTraduccion('Cancelar'),
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        background: isDarkMode ? '#2c2c2c' : '#fff',
        color: isDarkMode ? '#f5f5f5' : '#212529'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = `eliminar_recurso.php?id=${id}`;
        }
      });
    });
  });

  const urlParams = new URLSearchParams(window.location.search);

  if (urlParams.get('delete') === 'success') {
    Swal.fire({
      icon: 'success',
      title: obtenerTraduccion('Recurso eliminado correctamente'),
      showConfirmButton: false,
      timer: 1800,
      background: isDarkMode ? '#2c2c2c' : '#fff',
      color: isDarkMode ? '#f5f5f5' : '#212529'
    });
  }

  if (urlParams.get('edit') === 'success') {
    Swal.fire({
      icon: 'success',
      title: obtenerTraduccion('Recurso actualizado correctamente'),
      showConfirmButton: false,
      timer: 1800,
      background: isDarkMode ? '#2c2c2c' : '#fff',
      color: isDarkMode ? '#f5f5f5' : '#212529'
    });
  }

  if (urlParams.get('edit') === 'duplicate') {
    Swal.fire({
      icon: 'error',
      title: obtenerTraduccion('Ya existe un recurso con ese nombre'),
      showConfirmButton: true,
      background: isDarkMode ? '#2c2c2c' : '#fff',
      color: isDarkMode ? '#f5f5f5' : '#212529'
    });
  }

  if (urlParams.get('add') === 'success') {
    Swal.fire({
      icon: 'success',
      title: obtenerTraduccion('Recurso agregado correctamente'),
      showConfirmButton: false,
      timer: 1800,
      background: isDarkMode ? '#2c2c2c' : '#fff',
      color: isDarkMode ? '#f5f5f5' : '#212529'
    });
  }
});
