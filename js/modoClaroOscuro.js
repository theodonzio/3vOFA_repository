document.addEventListener('DOMContentLoaded', () => {
  const botonTema = document.getElementById('boton-tema');
  const cuerpo = document.body;
  const logoBarra = document.getElementById('logo-barra');

  if (!botonTema || !logoBarra) return;

  // --- Detectar ruta base según profundidad desde 3vOFA ---
  const path = window.location.pathname;
  const indexRoot = path.indexOf('/3vOFA_repository/');
  let relativePath = path.substring(indexRoot + '/3vOFA_repository/'.length);
  const segments = relativePath.split('/').filter(Boolean);

  let basePath = '';
  if (segments.length > 1) {
    basePath = '../'.repeat(segments.length - 1);
  }

  // --- Aplicar modo claro/oscuro ---
  function aplicarModo(modo) {
    if (modo === 'oscuro') {
      cuerpo.classList.add('oscuro');
      botonTema.src = `${basePath}img/icons/config_icon(white).png`;
      logoBarra.src = `${basePath}img/ofalogos/fulltextpositivo.png`;
    } else {
      cuerpo.classList.remove('oscuro');
      botonTema.src = `${basePath}img/icons/config_icon(black).png`;
      logoBarra.src = `${basePath}img/ofalogos/fulltextnegativo.png`;
    }
  }

  // Aplicar modo guardado o por defecto
  const modoGuardado = localStorage.getItem('modo');
  aplicarModo(modoGuardado || 'claro');

  // === OPCIONES DEL MENÚ DROPDOWN ===

  // Cambiar a modo claro
  document.getElementById('tema-claro').addEventListener('click', (e) => {
    e.preventDefault();
    aplicarModo('claro');
    localStorage.setItem('modo', 'claro');
  });

  // Cambiar a modo oscuro
  document.getElementById('tema-oscuro').addEventListener('click', (e) => {
    e.preventDefault();
    aplicarModo('oscuro');
    localStorage.setItem('modo', 'oscuro');
  });
});
