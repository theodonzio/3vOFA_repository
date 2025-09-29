// estudiante.js
const btnEstudiante = document.getElementById('btnEstudiante');
const selectContainer = document.getElementById('selectContainer');
const redirigirBtn = document.getElementById('redirigirBtn');
const opcionesEstudiante = document.getElementById('opcionesEstudiante');

// Mostrar/ocultar el select al hacer clic en el botón Estudiante
btnEstudiante.addEventListener('click', () => {
  selectContainer.style.display = selectContainer.style.display === 'none' ? 'block' : 'none';
});

// Redirigir según la opción seleccionada
redirigirBtn.addEventListener('click', () => {
  const url = opcionesEstudiante.value;
  if(url) {
    window.location.href = url;
  } else {
    alert("Selecciona una opción primero.");
  }
});
