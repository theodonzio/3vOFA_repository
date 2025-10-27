document.addEventListener('DOMContentLoaded', function() {
  const selectEspacio = document.getElementById('nombre_salon');
  const contenedorRecursos = document.getElementById('recursos-container');
  const listaRecursos = document.getElementById('recursos-list');

  if (!selectEspacio || !contenedorRecursos || !listaRecursos) return;

  selectEspacio.addEventListener('change', function() {
    const idEspacio = this.value;

    // Si no hay selección, ocultamos el bloque
    if (!idEspacio) {
      contenedorRecursos.style.display = 'none';
      listaRecursos.innerHTML = '';
      return;
    }

    // Cargar recursos mediante AJAX
    fetch(`../funciones/obtener_recursos.php?id_espacio=${idEspacio}`)
      .then(response => response.json())
      .then(data => {
        listaRecursos.innerHTML = '';

        if (data.length === 0) {
          listaRecursos.innerHTML = '<p class="text-muted">Este espacio no tiene recursos disponibles.</p>';
          contenedorRecursos.style.display = 'block';
          return;
        }

        // Crear checkbox por cada recurso
        data.forEach(recurso => {
          const div = document.createElement('div');
          div.classList.add('form-check', 'mb-1');

          const input = document.createElement('input');
          input.type = 'checkbox';
          input.classList.add('form-check-input');
          input.name = 'recursos[]';
          input.value = recurso.id_recurso;
          input.id = `recurso_${recurso.id_recurso}`;

          const label = document.createElement('label');
          label.classList.add('form-check-label');
          label.htmlFor = input.id;
          label.textContent = recurso.nombre_recurso;

          div.appendChild(input);
          div.appendChild(label);
          listaRecursos.appendChild(div);
        });

        contenedorRecursos.style.display = 'block';
      })
      .catch(error => {
        console.error('Error cargando recursos:', error);
        listaRecursos.innerHTML = '<p class="text-danger">Error al cargar los recursos.</p>';
        contenedorRecursos.style.display = 'block';
      });
  });
});
