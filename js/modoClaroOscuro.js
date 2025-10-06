document.addEventListener('DOMContentLoaded', () => {
  const botonTema = document.getElementById('boton-tema');
  const cuerpo = document.body;
  const logoBarra = document.getElementById('logo-barra');

  if (!botonTema || !logoBarra) return;

  // --- Detectar ruta base según profundidad desde 3vOFA ---
  const path = window.location.pathname;
  const indexRoot = path.indexOf('/3vOFA/');
  let relativePath = path.substring(indexRoot + '/3vOFA/'.length);
  const segments = relativePath.split('/').filter(Boolean); // elimina vacíos

  // Si el archivo está dentro de php/, php/login/, php/PaginasDocentes/, etc.
  // contamos cuántos niveles tiene y generamos "../" en consecuencia
  let basePath = '';
  if (segments.length > 1) {
    basePath = '../'.repeat(segments.length - 1);
  }

  function aplicarModo(modo) {
    if (modo === 'oscuro') {
      cuerpo.classList.add('oscuro');
      botonTema.textContent = 'Oscuro';
      logoBarra.src = `${basePath}img/ofalogos/fulltextpositivo.png`;
    } else {
      cuerpo.classList.remove('oscuro');
      botonTema.textContent = 'Claro';
      logoBarra.src = `${basePath}img/ofalogos/fulltextnegativo.png`;
    }
  }

  // Aplicar modo guardado o por defecto
  const modoGuardado = localStorage.getItem('modo');
  aplicarModo(modoGuardado || 'claro');

  // Cambiar tema al hacer clic
  botonTema.addEventListener('click', (e) => {
    e.preventDefault();
    const nuevoModo = cuerpo.classList.contains('oscuro') ? 'claro' : 'oscuro';
    aplicarModo(nuevoModo);
    localStorage.setItem('modo', nuevoModo);
  });
});

