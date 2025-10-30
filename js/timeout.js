/**
 * Sistema de cierre de sesión por inactividad
 * Cierra la sesión después de 15 minutos sin actividad
 */

(function() {
  'use strict';

  // Configuración
  const INACTIVITY_TIME = 15 * 60 * 1000; // 15 minutos en milisegundos
  const WARNING_TIME = 14 * 60 * 1000; // Mostrar advertencia 1 minuto antes
  
  let inactivityTimer;
  let warningTimer;
  let lastActivityTime = Date.now();
  let warningShown = false;

  /**
   * Eventos que resetean el temporizador de inactividad
   */
  const activityEvents = [
    'mousedown',
    'mousemove',
    'keydown',
    'scroll',
    'touchstart',
    'click',
    'keypress'
  ];

  /**
   * Registrar actividad del usuario
   */
  function registerActivity() {
    lastActivityTime = Date.now();
    warningShown = false;
    clearAllTimers();
    startInactivityTimer();
  }

  /**
   * Limpiar todos los temporizadores
   */
  function clearAllTimers() {
    if (inactivityTimer) {
      clearTimeout(inactivityTimer);
    }
    if (warningTimer) {
      clearTimeout(warningTimer);
    }
  }

  /**
   * Iniciar el temporizador de inactividad
   */
  function startInactivityTimer() {
    // Temporizador para mostrar advertencia
    warningTimer = setTimeout(showWarning, WARNING_TIME);

    // Temporizador para cerrar sesión
    inactivityTimer = setTimeout(endSession, INACTIVITY_TIME);
  }

  /**
   * Mostrar advertencia de sesión por expirar
   */
  function showWarning() {
    if (warningShown) return;
    warningShown = true;

    const isDarkMode = document.body.classList.contains('oscuro');

    Swal.fire({
      title: '⏰ Advertencia de Inactividad',
      html: '<p>Tu sesión expirará en <strong>1 minuto</strong> por inactividad.</p><p><small>Realiza cualquier acción para continuar en el sistema.</small></p>',
      icon: 'warning',
      allowOutsideClick: false,
      allowEscapeKey: false,
      showConfirmButton: true,
      confirmButtonText: 'Continuar',
      confirmButtonColor: '#ffc107',
      background: isDarkMode ? '#2c2c2c' : '#fff',
      color: isDarkMode ? '#f5f5f5' : '#212529',
      timer: 60000,
      timerProgressBar: true,
      didOpen: () => {
        // Si el usuario interactúa con el alert, resetear inactividad
        const confirmButton = Swal.getConfirmButton();
        if (confirmButton) {
          confirmButton.addEventListener('click', registerActivity);
        }
      }
    });
  }

  /**
   * Cerrar sesión por inactividad
   */
  function endSession() {
    const isDarkMode = document.body.classList.contains('oscuro');

    Swal.fire({
      title: 'Sesión Expirada',
      html: '<p>Tu sesión ha finalizado por <strong>inactividad (15 minutos)</strong>.</p><p><small>Por tu seguridad, debes iniciar sesión nuevamente.</small></p>',
      icon: 'info',
      allowOutsideClick: false,
      allowEscapeKey: false,
      showConfirmButton: true,
      confirmButtonText: 'Ir a Login',
      confirmButtonColor: '#0d6efd',
      background: isDarkMode ? '#2c2c2c' : '#fff',
      color: isDarkMode ? '#f5f5f5' : '#212529'
    }).then(() => {
      // Cerrar sesión y redirigir
      window.location.href = '../index.php';
    });
  }

  /**
   * Inicializar el sistema
   */
  function init() {
    // Solo ejecutar si estamos en una página autenticada
    if (!isUserLoggedIn()) {
      return;
    }

    // Registrar eventos de actividad
    activityEvents.forEach(event => {
      document.addEventListener(event, registerActivity, true);
    });

    // Iniciar temporizador
    startInactivityTimer();

    console.log('✓ Sistema de inactividad inicializado (15 minutos)');
  }

  /**
   * Verificar si el usuario está autenticado
   * Comprobamos si existe el elemento de header autenticado
   */
  function isUserLoggedIn() {
    // Verificar si existen headers de usuario autenticado
    const headerAdscripta = document.querySelector('#header_nav');
    const headerDocente = document.querySelector('#header_nav');
    const headerEstudiante = document.querySelector('#header_nav');
    
    return headerAdscripta || headerDocente || headerEstudiante;
  }

  /**
   * Cleanup: limpiar eventos al descargar
   */
  window.addEventListener('beforeunload', () => {
    clearAllTimers();
    activityEvents.forEach(event => {
      document.removeEventListener(event, registerActivity, true);
    });
  });

  // Inicializar cuando el DOM esté listo
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  // Exportar para uso manual si es necesario
  window.SessionManager = {
    resetTimer: registerActivity,
    endSession: endSession,
    showWarning: showWarning
  };

})();