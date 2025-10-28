// notificaciones-adscripta.js
// Manejo de notificaciones SweetAlert para la página de adscripta

document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const isDarkMode = document.body.classList.contains('oscuro');
    
    const swalConfig = {
        background: isDarkMode ? '#2c2c2c' : '#fff',
        color: isDarkMode ? '#f5f5f5' : '#212529',
        confirmButtonColor: '#198754'
    };

    // Notificación de Curso
    if (urlParams.has('curso')) {
        const tipo = urlParams.get('curso');
        if (tipo === 'success') {
            Swal.fire({
                icon: 'success',
                title: '¡Curso agregado!',
                text: 'El nuevo curso ha sido registrado exitosamente en el sistema.',
                timer: 2500,
                showConfirmButton: true,
                ...swalConfig
            });
        } else if (tipo === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Error al registrar',
                text: 'No se pudo agregar el curso. Por favor, intenta nuevamente.',
                confirmButtonColor: '#dc3545',
                ...swalConfig
            });
        }
        // Limpiar URL
        window.history.replaceState({}, document.title, window.location.pathname);
    }

    // Notificación de Docente
    if (urlParams.has('docente')) {
        const tipo = urlParams.get('docente');
        let titulo = '';
        let mensaje = '';
        let icono = 'error';

        switch (tipo) {
            case 'success':
                titulo = '¡Docente registrado!';
                mensaje = 'El docente ha sido agregado correctamente al sistema.';
                icono = 'success';
                break;
            case 'cedula_invalida':
                titulo = 'Cédula inválida';
                mensaje = 'La cédula debe tener exactamente 8 números sin puntos ni guiones.';
                break;
            case 'contrasena_invalida':
                titulo = 'Contraseña inválida';
                mensaje = 'La contraseña debe tener al menos 6 caracteres, incluyendo letras y números.';
                break;
            case 'error':
                titulo = 'Error al registrar';
                mensaje = 'Ocurrió un error al registrar el docente. Por favor, intenta nuevamente.';
                break;
        }

        if (mensaje) {
            Swal.fire({
                title: titulo,
                text: mensaje,
                icon: icono,
                confirmButtonColor: icono === 'success' ? '#198754' : '#dc3545',
                ...swalConfig
            });
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    }

    // Notificación de Espacio
    if (urlParams.has('espacio')) {
        const tipo = urlParams.get('espacio');
        if (tipo === 'success') {
            Swal.fire({
                icon: 'success',
                title: '¡Espacio agregado!',
                text: 'El nuevo espacio ha sido registrado correctamente en el sistema.',
                timer: 2500,
                showConfirmButton: true,
                ...swalConfig
            });
        } else if (tipo === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Error al registrar',
                text: 'No se pudo agregar el espacio. Por favor, intenta nuevamente.',
                confirmButtonColor: '#dc3545',
                ...swalConfig
            });
        } else if (tipo === 'duplicado') {
            Swal.fire({
                icon: 'warning',
                title: 'Espacio duplicado',
                text: 'Ya existe un espacio con esas características en el sistema.',
                confirmButtonColor: '#ffc107',
                ...swalConfig
            });
        }
        window.history.replaceState({}, document.title, window.location.pathname);
    }

    // Notificación de Grupo
    if (urlParams.has('grupo')) {
        const tipo = urlParams.get('grupo');
        if (tipo === 'success') {
            Swal.fire({
                icon: 'success',
                title: '¡Grupo agregado!',
                text: 'El nuevo grupo ha sido creado exitosamente.',
                timer: 2500,
                showConfirmButton: true,
                ...swalConfig
            });
        } else if (tipo === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Error al crear grupo',
                text: 'No se pudo agregar el grupo. Verifica los datos e intenta nuevamente.',
                confirmButtonColor: '#dc3545',
                ...swalConfig
            });
        }
        window.history.replaceState({}, document.title, window.location.pathname);
    }

    // Notificación de Asignatura
    if (urlParams.has('asignatura')) {
        const tipo = urlParams.get('asignatura');
        if (tipo === 'success') {
            Swal.fire({
                icon: 'success',
                title: '¡Asignatura agregada!',
                text: 'La asignatura ha sido registrada correctamente.',
                timer: 2500,
                showConfirmButton: true,
                ...swalConfig
            });
        } else if (tipo === 'duplicado') {
            Swal.fire({
                icon: 'warning',
                title: 'Asignatura duplicada',
                text: 'Esta asignatura ya está asignada a este grupo con este docente.',
                confirmButtonColor: '#ffc107',
                ...swalConfig
            });
        } else if (tipo === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Error al agregar asignatura',
                text: 'No se pudo registrar la asignatura. Intenta nuevamente.',
                confirmButtonColor: '#dc3545',
                ...swalConfig
            });
        }
        window.history.replaceState({}, document.title, window.location.pathname);
    }

    // Notificación de Horario
    if (urlParams.has('horario')) {
        const tipo = urlParams.get('horario');
        if (tipo === 'success') {
            Swal.fire({
                icon: 'success',
                title: '¡Horario guardado!',
                text: 'El horario ha sido actualizado correctamente.',
                timer: 2500,
                showConfirmButton: true,
                ...swalConfig
            });
        } else if (tipo === 'eliminado') {
            Swal.fire({
                icon: 'success',
                title: '¡Horario eliminado!',
                text: 'El horario ha sido eliminado del sistema.',
                timer: 2500,
                showConfirmButton: true,
                ...swalConfig
            });
        } else if (tipo === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Error con el horario',
                text: 'No se pudo procesar la operación. Intenta nuevamente.',
                confirmButtonColor: '#dc3545',
                ...swalConfig
            });
        }
        window.history.replaceState({}, document.title, window.location.pathname);
    }

    // Notificación de acción sobre Reserva
    if (urlParams.has('reserva_action')) {
        const tipo = urlParams.get('reserva_action');
        const mensaje = urlParams.get('mensaje') || 'Acción completada';
        
        if (tipo === 'success') {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: mensaje,
                timer: 2500,
                showConfirmButton: true,
                ...swalConfig
            });
        } else if (tipo === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: `
                    <p>${mensaje}</p>
                    <small class="text-muted">Si el problema persiste, contacta al administrador.</small>
                `,
                confirmButtonColor: '#dc3545',
                ...swalConfig
            });
        }
        window.history.replaceState({}, document.title, window.location.pathname);
    }

    // Notificación genérica de éxito
    if (urlParams.has('success')) {
        const mensaje = urlParams.get('mensaje') || 'Operación completada exitosamente';
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: mensaje,
            timer: 2500,
            showConfirmButton: true,
            ...swalConfig
        });
        window.history.replaceState({}, document.title, window.location.pathname);
    }

    // Notificación genérica de error
    if (urlParams.has('error')) {
        const mensaje = urlParams.get('mensaje') || 'Ocurrió un error al procesar la operación';
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: mensaje,
            confirmButtonColor: '#dc3545',
            ...swalConfig
        });
        window.history.replaceState({}, document.title, window.location.pathname);
    }
});
  document.addEventListener("DOMContentLoaded", () => {
    const params = new URLSearchParams(window.location.search);

    // ✅ Si el horario se agregó correctamente
    if (params.get("success") === "horario") {
      Swal.fire({
        title: "¡Horario agregado!",
        text: "El nuevo horario fue guardado exitosamente.",
        icon: "success",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#3085d6",
        timer: 2500,
        timerProgressBar: true
      }).then(() => {
        // Limpia el parámetro de la URL
        const newURL = window.location.origin + window.location.pathname;
        window.history.replaceState({}, document.title, newURL);
      });
    }

    // ❌ Si hubo un error al agregar
    if (params.get("error") === "horario") {
      Swal.fire({
        title: "Error",
        text: "No se pudo agregar el horario. Intenta nuevamente.",
        icon: "error",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#d33"
      }).then(() => {
        const newURL = window.location.origin + window.location.pathname;
        window.history.replaceState({}, document.title, newURL);
      });
    }
  });