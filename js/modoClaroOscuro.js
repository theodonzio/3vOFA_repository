document.addEventListener('DOMContentLoaded', () => {
  const botonTema = document.getElementById('boton-tema');
  const cuerpo = document.body;
  const logoBarra = document.getElementById('logo-barra');

  if (!botonTema || !logoBarra) return;

  // --- Detectar ruta base según profundidad desde 3vOFA ---
  const path = window.location.pathname;
  const indexRoot = path.indexOf('/3vOFA/');
  let relativePath = path.substring(indexRoot + '/3vOFA/'.length);
  const segments = relativePath.split('/').filter(Boolean);

  let basePath = '';
  if (segments.length > 1) {
    basePath = '../'.repeat(segments.length - 1);
  }

  function aplicarModo(modo) {
    if (modo === 'oscuro') {
      cuerpo.classList.add('oscuro');
      botonTema.src = `${basePath}img/icons/moon_icon.png`;
      botonTema.style.filter = 'invert(1)'; // Aplicar invert al ícono
      logoBarra.src = `${basePath}img/ofalogos/fulltextpositivo.png`;
    } else {
      cuerpo.classList.remove('oscuro');
      botonTema.src = `${basePath}img/icons/sun_icon.png`;
      botonTema.style.filter = 'invert(0)'; // Quitar invert
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
