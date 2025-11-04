(function() {
  'use strict';

  // Configuración
  const INACTIVITY_TIME = 15 * 60 * 1000; // 15 minutos en milisegundos
  const WARNING_TIME = 14 * 60 * 1000; // Mostrar advertencia 1 minuto antes
  
  let inactivityTimer;
  let warningTimer;
  let lastActivityTime = Date.now();
  let warningShown = false;

  
   //Eventos que resetean el temporizador de inactividad
   
  const activityEvents = [
    'mousedown',
    'mousemove',
    'keydown',
    'scroll',
    'touchstart',
    'click',
    'keypress'
  ];

  
   //Registra actividad del usuario
   
  function registerActivity() {
    lastActivityTime = Date.now();
    warningShown = false;
    clearAllTimers();
    startInactivityTimer();
  }

  
   //Limpia todos los temporizadores
   
  function clearAllTimers() {
    if (inactivityTimer) {
      clearTimeout(inactivityTimer);
    }
    if (warningTimer) {
      clearTimeout(warningTimer);
    }
  }

  
   //Inicia el temporizador de inactividad
   
  function startInactivityTimer() {
    // Temporizador para mostrar advertencia
    warningTimer = setTimeout(showWarning, WARNING_TIME);

    // Temporizador para cerrar sesión
    inactivityTimer = setTimeout(endSession, INACTIVITY_TIME);
  }

  //Muestra advertencia de sesión por expirar
   
  function showWarning() {
    if (warningShown) return;
    warningShown = true;

    const isDarkMode = document.body.classList.contains('oscuro');

    Swal.fire({
      title: obtenerTraduccion('Advertencia de Inactividad'),
      html: `<p>${obtenerTraduccion('Tu sesión expirará en')} <strong>1 ${obtenerTraduccion('minuto')}</strong> ${obtenerTraduccion('por inactividad')}.</p>
             <p><small>${obtenerTraduccion('Realiza cualquier acción para continuar en el sistema')}.</small></p>`,
      icon: 'warning',
      allowOutsideClick: false,
      allowEscapeKey: false,
      showConfirmButton: true,
      confirmButtonText: obtenerTraduccion('Continuar'),
      confirmButtonColor: '#ffc107',
      background: isDarkMode ? '#2c2c2c' : '#fff',
      color: isDarkMode ? '#f5f5f5' : '#212529',
      timer: 60000,
      timerProgressBar: true,
      didOpen: () => {
        // Si el usuario interactúa con el alert, resetea inactividad
        const confirmButton = Swal.getConfirmButton();
        if (confirmButton) {
          confirmButton.addEventListener('click', registerActivity);
        }
      }
    });
  }

 
   //Cierra sesión por inactividad
  
  function endSession() {
    const isDarkMode = document.body.classList.contains('oscuro');

    Swal.fire({
      title: obtenerTraduccion('Sesión Expirada'),
      html: `<p>${obtenerTraduccion('Tu sesión ha finalizado por')} <strong>${obtenerTraduccion('inactividad')} (15 ${obtenerTraduccion('minutos')})</strong>.</p>
             <p><small>${obtenerTraduccion('Por tu seguridad, debes iniciar sesión nuevamente')}.</small></p>`,
      icon: 'info',
      allowOutsideClick: false,
      allowEscapeKey: false,
      showConfirmButton: true,
      confirmButtonText: obtenerTraduccion('Ir a Login'),
      confirmButtonColor: '#0d6efd',
      background: isDarkMode ? '#2c2c2c' : '#fff',
      color: isDarkMode ? '#f5f5f5' : '#212529'
    }).then(() => {
      // Cierra sesión y redirigir
      window.location.href = '../index.php';
    });
  }

 
   //Inicializa el sistema
   
  function init() {
    // Solo ejecuta si estamos en una página autenticada
    if (!isUserLoggedIn()) {
      return;
    }

    // Registra eventos de actividad
    activityEvents.forEach(event => {
      document.addEventListener(event, registerActivity, true);
    });

    // Inicia temporizador
    startInactivityTimer();

    console.log('✓ Sistema de inactividad inicializado (15 minutos)');
  }

  
   //Verifica si el usuario está autenticado
   //Comprueba si existe el elemento de header autenticado
   
  function isUserLoggedIn() {
    // Verifica si existen headers de usuario autenticado
    const headerAdscripta = document.querySelector('#header_nav');
    const headerDocente = document.querySelector('#header_nav');
    const headerEstudiante = document.querySelector('#header_nav');
    
    return headerAdscripta || headerDocente || headerEstudiante;
  }

  //Limpia eventos al descargar
  window.addEventListener('beforeunload', () => {
    clearAllTimers();
    activityEvents.forEach(event => {
      document.removeEventListener(event, registerActivity, true);
    });
  });

  // Inicializa cuando el DOM esté listo
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  // Exporta para uso manual si es necesario
  window.SessionManager = {
    resetTimer: registerActivity,
    endSession: endSession,
    showWarning: showWarning
  };

})(); 