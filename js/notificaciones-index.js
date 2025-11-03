/** Gestiona SweetAlert para diferentes estados de login */

document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const isDarkMode = document.body.classList.contains('oscuro');
    
    const swalConfig = {
        background: isDarkMode ? '#2c2c2c' : '#fff',
        color: isDarkMode ? '#f5f5f5' : '#212529'
    };

    // Notificación de login exitoso
    if (urlParams.has('login') && urlParams.get('login') === 'success') {
        const rol = urlParams.get('rol') || '';

        Swal.fire({
            icon: 'success',
            title: 'Inicio de sesión correcto',
            text: 'Bienvenido/a al sistema.',
            timer: 1800,
            showConfirmButton: false,
            ...swalConfig
        }).then(() => {
            
            // Redirigir según rol
            if (rol === '1') {
                window.location.href = 'usuarios/adscripta.php';
            } else if (rol === '2') {
                window.location.href = 'usuarios/docente.php';
            } else {
                window.location.href = 'usuarios/estudiante.php';
            }
        });
    }

    // Notificación de contraseña incorrecta
    if (urlParams.has('login') && urlParams.get('login') === 'error_pass') {
        Swal.fire({
            icon: 'error',
            title: 'Contraseña incorrecta',
            text: 'Verifica tu contraseña e inténtalo de nuevo.',
            confirmButtonText: 'Intentar de nuevo',
            ...swalConfig
        });
    }

    // Notificación de usuario no encontrado
    if (urlParams.has('login') && urlParams.get('login') === 'error_user') {
        Swal.fire({
            icon: 'warning',
            title: 'Usuario no encontrado',
            text: 'No existe una cuenta con ese correo o cédula.',
            confirmButtonText: 'OK',
            ...swalConfig
        });
    }

    // Notificación de login requerido
    if (urlParams.has('login') && urlParams.get('login') === 'required') {
        Swal.fire({
            icon: 'warning',
            title: 'Inicia sesión primero',
            text: 'Debes iniciar sesión para acceder al sistema.',
            confirmButtonText: 'Entendido',
            ...swalConfig
        });
    }

    // Notificación de acceso no autorizado
    if (urlParams.has('login') && urlParams.get('login') === 'unauthorized') {
        Swal.fire({
            icon: 'error',
            title: 'Acceso no autorizado',
            text: 'No tienes permisos para acceder a esa página.',
            confirmButtonText: 'OK',
            ...swalConfig
        });
    }

    // Limpiar URL después de mostrar notificación
    if (urlParams.has('login')) {
        window.history.replaceState({}, document.title, window.location.pathname);
    }
});