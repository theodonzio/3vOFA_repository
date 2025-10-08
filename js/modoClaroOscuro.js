document.addEventListener('DOMContentLoaded', () => {
  const botonTema = document.getElementById('boton-tema');
  const cuerpo = document.body;
  const logoBarra = document.getElementById('logo-barra');

  if (!botonTema || !logoBarra) return;

  // --- Ruta base relativa ---
  const basePath = '../../';

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

  // === Opciones del menú ===
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
