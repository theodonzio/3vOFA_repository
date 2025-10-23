/**
 * Manejo de notificaciones para la página de docente
 * Gestiona SweetAlert para diferentes estados de reservas
 */

document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const isDarkMode = document.body.classList.contains('oscuro');
    
    const swalConfig = {
        background: isDarkMode ? '#2c2c2c' : '#fff',
        color: isDarkMode ? '#f5f5f5' : '#212529'
    };

    // Notificación de reserva exitosa
    if (urlParams.has('reserva') && urlParams.get('reserva') === 'success') {
        Swal.fire({
            icon: 'success',
            title: '¡Reserva realizada!',
            text: 'Tu reserva fue registrada correctamente.',
            confirmButtonColor: '#198754',
            ...swalConfig
        });
    }

    // Notificación de fecha u hora inválida
    if (urlParams.has('reserva') && urlParams.get('reserva') === 'error_fecha') {
        Swal.fire({
            icon: 'error',
            title: 'Fecha u hora inválida',
            text: 'No puedes reservar en una fecha u hora pasada.',
            confirmButtonColor: '#dc3545',
            ...swalConfig
        });
    }

    // Notificación de error general
    if (urlParams.has('reserva') && urlParams.get('reserva') === 'error') {
        Swal.fire({
            icon: 'error',
            title: 'Error al reservar',
            text: 'Ocurrió un error al registrar tu reserva. Intenta nuevamente.',
            confirmButtonColor: '#dc3545',
            ...swalConfig
        });
    }

    // Limpiar URL después de mostrar notificación
    if (urlParams.has('reserva')) {
        window.history.replaceState({}, document.title, window.location.pathname);
    }
});