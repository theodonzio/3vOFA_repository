document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.eliminar-curso').forEach(boton => {
    boton.addEventListener('click', (e) => {
      e.preventDefault();

      const id = boton.dataset.id;
      const nombre = boton.dataset.nombre;
      const isDarkMode = document.body.classList.contains('oscuro');

      Swal.fire({
        title: obtenerTraduccion('¿Eliminar curso?'),
        text: `${obtenerTraduccion('Se eliminará el curso')} "${nombre}" ${obtenerTraduccion('del sistema')}.`,
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
          window.location.href = `eliminar_curso.php?id=${id}`;
        }
      });
    });
  });

  const urlParams = new URLSearchParams(window.location.search);
  const isDarkMode = document.body.classList.contains('oscuro');

  if (urlParams.get('delete') === 'success') {
    Swal.fire({
      icon: 'success',
      title: obtenerTraduccion('Curso eliminado correctamente'),
      showConfirmButton: false,
      timer: 1800,
      background: isDarkMode ? '#2c2c2c' : '#fff',
      color: isDarkMode ? '#f5f5f5' : '#212529'
    });
  }

  if (urlParams.get('edit') === 'success') {
    Swal.fire({
      icon: 'success',
      title: obtenerTraduccion('Curso actualizado correctamente'),
      showConfirmButton: false,
      timer: 1800,
      background: isDarkMode ? '#2c2c2c' : '#fff',
      color: isDarkMode ? '#f5f5f5' : '#212529'
    });
  }
});
