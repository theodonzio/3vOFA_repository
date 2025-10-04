const botonTema = document.getElementById('boton-tema');
const cuerpo = document.body;

function aplicarModo(modo) {
  if (modo === 'oscuro') {
    cuerpo.classList.add('oscuro');
    botonTema.textContent = 'Tema: Claro';
  } else {
    cuerpo.classList.remove('oscuro');
    botonTema.textContent = 'Tema: Oscuro';
  }
}

// Verificar modo guardado al cargar
const modoGuardado = localStorage.getItem('modo');
aplicarModo(modoGuardado || 'claro');

// Cambiar tema al hacer clic
botonTema.addEventListener('click', (e) => {
  e.preventDefault(); // evita que recargue el menú
  const nuevoModo = cuerpo.classList.contains('oscuro') ? 'claro' : 'oscuro';
  aplicarModo(nuevoModo);
  localStorage.setItem('modo', nuevoModo);
});
