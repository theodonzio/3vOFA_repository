// notificaciones-adscripta.js
// Manejo de notificaciones SweetAlert para la página de adscripta

document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const isDarkMode = document.body.classList.contains('oscuro');
    
    const swalConfig = {
        background: isDarkMode ? '#2c2c2c' : '#fff',
        color: isDarkMode ? '#f5f5f5' : '#212529'
    };

    // Notificación de Curso
    if (urlParams.has('curso')) {
        const tipo = urlParams.get('curso');
        if (tipo === 'success') {
            Swal.fire({
                icon: 'success',
                title: '¡Curso agregado correctamente!',
                text: 'El nuevo curso ha sido registrado en el sistema.',
                confirmButtonColor: '#198754',
                ...swalConfig
            });
        } else if (tipo === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Error al registrar',
                text: 'No se pudo agregar el curso. Intenta nuevamente.',
                confirmButtonColor: '#dc3545',
                ...swalConfig
            });
        }
    }

    // Notificación de Docente
    if (urlParams.has('docente')) {
        const tipo = urlParams.get('docente');
        let mensaje = '';
        let icono = 'error';

        switch (tipo) {
            case 'success':
                mensaje = 'Docente registrado correctamente ✅';
                icono = 'success';
                break;
            case 'cedula_invalida':
                mensaje = 'La cédula debe tener exactamente 8 números.';
                break;
            case 'contrasena_invalida':
                mensaje = 'La contraseña debe tener al menos una letra, un número y 6 caracteres.';
                break;
            case 'error':
                mensaje = 'Ocurrió un error al registrar. Intente nuevamente.';
                break;
        }

        if (mensaje) {
            Swal.fire({
                title: mensaje,
                icon: icono,
                confirmButtonText: 'Aceptar',
                ...swalConfig
            });
        }
    }

    // Notificación de Espacio
    if (urlParams.has('espacio')) {
        const tipo = urlParams.get('espacio');
        if (tipo === 'success') {
            Swal.fire({
                icon: 'success',
                title: '¡Espacio agregado correctamente!',
                text: 'El nuevo espacio ha sido registrado en el sistema.',
                confirmButtonColor: '#198754',
                ...swalConfig
            });
        } else if (tipo === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Error al registrar',
                text: 'No se pudo agregar el espacio. Intenta nuevamente.',
                confirmButtonColor: '#dc3545',
                ...swalConfig
            });
        } else if (tipo === 'duplicado') {
            Swal.fire({
                icon: 'warning',
                title: 'Espacio duplicado',
                text: 'Ya existe un espacio con esas características.',
                confirmButtonColor: '#ffc107',
                ...swalConfig
            });
        }
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
                confirmButtonColor: '#198754',
                ...swalConfig
            }).then(() => {
                // Limpiar la URL después de mostrar la notificación
                window.history.replaceState({}, document.title, window.location.pathname);
            });
        } else if (tipo === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: mensaje,
                confirmButtonColor: '#dc3545',
                ...swalConfig,
                html: `
                    <p>${mensaje}</p>
                    <small class="text-muted">Si el problema persiste, contacta al administrador.</small>
                `
            }).then(() => {
                // Limpiar la URL después de mostrar la notificación
                window.history.replaceState({}, document.title, window.location.pathname);
            });
        }
    }
});