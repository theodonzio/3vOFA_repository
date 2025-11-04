
document.addEventListener('DOMContentLoaded', () => {
  const isDarkMode = document.body.classList.contains('oscuro');

  document.querySelectorAll('.eliminar-asignatura').forEach(boton => {
    boton.addEventListener('click', (e) => {
      e.preventDefault();
      const id = boton.dataset.id;
      const nombre = boton.dataset.nombre;

      Swal.fire({
        title: obtenerTraduccion('¿Eliminar asignatura?'),
        text: `${obtenerTraduccion('Se eliminará')} "${nombre}" ${obtenerTraduccion('del sistema')}.`,
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
          window.location.href = `eliminar_asignatura.php?id=${id}`;
        }
      });
    });
  });

  const urlParams = new URLSearchParams(window.location.search);

  if (urlParams.get('delete') === 'success') {
    Swal.fire({
      icon: 'success',
      title: obtenerTraduccion('Asignatura eliminada correctamente'),
      showConfirmButton: false,
      timer: 1800,
      background: isDarkMode ? '#2c2c2c' : '#fff',
      color: isDarkMode ? '#f5f5f5' : '#212529'
    });
  }

  if (urlParams.get('edit') === 'success') {
    Swal.fire({
      icon: 'success',
      title: obtenerTraduccion('Asignatura actualizada correctamente'),
      showConfirmButton: false,
      timer: 1800,
      background: isDarkMode ? '#2c2c2c' : '#fff',
      color: isDarkMode ? '#f5f5f5' : '#212529'
    });
  }

  if (urlParams.get('add') === 'success') {
    Swal.fire({
      icon: 'success',
      title: obtenerTraduccion('Asignatura agregada correctamente'),
      showConfirmButton: false,
      timer: 1800,
      background: isDarkMode ? '#2c2c2c' : '#fff',
      color: isDarkMode ? '#f5f5f5' : '#212529'
    });
  }
});
