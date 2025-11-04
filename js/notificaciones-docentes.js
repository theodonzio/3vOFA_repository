  document.addEventListener('DOMContentLoaded', () => {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));

    const params = new URLSearchParams(window.location.search);
    const isDarkMode = document.body.classList.contains('oscuro');
    
    const swalConfig = {
      background: isDarkMode ? '#2c2c2c' : '#fff',
      color: isDarkMode ? '#f5f5f5' : '#212529'
    };

    if (params.get('edit') === 'success') {
      Swal.fire({
        icon: 'success',
        title: obtenerTraduccion('¡Docente actualizado!'),
        text: obtenerTraduccion('Los datos del docente se actualizaron correctamente.'),
        confirmButtonColor: '#198754',
        timer: 2500,
        ...swalConfig
      }).then(() => {
        window.history.replaceState({}, document.title, window.location.pathname);
      });
    }

    if (params.get('delete') === 'success') {
      Swal.fire({
        icon: 'success',
        title: obtenerTraduccion('¡Docente eliminado!'),
        text: obtenerTraduccion('El docente fue eliminado del sistema correctamente.'),
        confirmButtonColor: '#198754',
        timer: 2500,
        ...swalConfig
      }).then(() => {
        window.history.replaceState({}, document.title, window.location.pathname);
      });
    }

    if (params.get('edit') === 'cedula_invalida') {
      Swal.fire({
        icon: 'error',
        title: obtenerTraduccion('Cédula inválida'),
        text: obtenerTraduccion('La cédula debe tener exactamente 8 dígitos numéricos sin puntos ni guiones.'),
        confirmButtonColor: '#dc3545',
        ...swalConfig
      }).then(() => {
        window.history.replaceState({}, document.title, window.location.pathname);
      });
    }

    if (params.get('edit') === 'cedula_dv_invalido') {
      Swal.fire({
        icon: 'error',
        title: obtenerTraduccion('Cédula inválida'),
        text: obtenerTraduccion('La cédula ingresada no es válida. El dígito verificador no coincide.'),
        confirmButtonColor: '#dc3545',
        ...swalConfig
      }).then(() => {
        window.history.replaceState({}, document.title, window.location.pathname);
      });
    }

    if (params.get('edit') === 'duplicado') {
      Swal.fire({
        icon: 'warning',
        title: obtenerTraduccion('Datos duplicados'),
        text: obtenerTraduccion('Ya existe otro docente con esa cédula o correo electrónico.'),
        confirmButtonColor: '#ffc107',
        ...swalConfig
      }).then(() => {
        window.history.replaceState({}, document.title, window.location.pathname);
      });
    }

    if (params.get('edit') === 'error' || params.get('delete') === 'error') {
      Swal.fire({
        icon: 'error',
        title: obtenerTraduccion('Error'),
        text: obtenerTraduccion('Ocurrió un error al procesar la operación. Intenta nuevamente.'),
        confirmButtonColor: '#dc3545',
        ...swalConfig
      }).then(() => {
        window.history.replaceState({}, document.title, window.location.pathname);
      });
    }
  });

  document.querySelectorAll('.eliminar-docente').forEach(boton => {
    boton.addEventListener('click', (e) => {
      e.preventDefault();

      const id = boton.dataset.id;
      const nombre = boton.dataset.nombre;
      const isDarkMode = document.body.classList.contains('oscuro');

      Swal.fire({
        title: obtenerTraduccion('¿Eliminar docente?'),
        text: `${obtenerTraduccion('Se eliminará a')} ${nombre} ${obtenerTraduccion('del sistema')}.`,
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
          window.location.href = `eliminar_docente.php?id=${id}`;
        }
      });
    });
  });
