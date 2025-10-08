document.addEventListener('DOMContentLoaded', () => {
  const botonTema = document.getElementById('boton-tema');
  const cuerpo = document.body;
  const logoBarra = document.getElementById('logo-barra');

  if (!botonTema || !logoBarra) return;

  // --- Detección automática de nivel de ruta ---
  const currentPath = window.location.pathname;

  // Si el archivo actual NO es /php/index.php → estamos en una subcarpeta
  const isSubfolder = !currentPath.endsWith('/php/index.php') && !currentPath.endsWith('/php/index');

  // Ruta base dinámica
  const basePath = isSubfolder ? '../../' : '../';

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

  // === Eventos del menú ===
  document.getElementById('tema-claro').addEventListener('click', (e) => {
    e.preventDefault();
    aplicarModo('claro');
    localStorage.setItem('modo', 'claro');
  });

  document.getElementById('tema-oscuro').addEventListener('click', (e) => {
    e.preventDefault();
    aplicarModo('oscuro');
    localStorage.setItem('modo', 'oscuro');
  });
});
