/** Carga recursos dinámicamente cuando se selecciona un espacio
  y los muestra con checkboxes para que el docente pueda seleccionarlos */

document.addEventListener('DOMContentLoaded', function() {
    const espacioSelect = document.getElementById('nombre_salon');
    const recursosContainer = document.getElementById('recursos-container');
    const recursosList = document.getElementById('recursos-list');

    if (!espacioSelect || !recursosContainer || !recursosList) {
        console.error('Elementos necesarios no encontrados en el DOM');
        return;
    }

    // Escuchar cambios en el selector de espacio
    espacioSelect.addEventListener('change', function() {
        const idEspacio = this.value;
        
        if (!idEspacio) {
            // Si no hay espacio seleccionado, oculta recursos
            recursosContainer.style.display = 'none';
            recursosList.innerHTML = '';
            return;
        }

        // Hace petición para obtener recursos del espacio
        fetch(`../funciones/obtener_recursos.php?id_espacio=${idEspacio}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(recursos => {
                
                // Limpia lista anterior
                recursosList.innerHTML = '';

                if (recursos.length === 0) {
                    
                    // No hay recursos disponibles
                    recursosList.innerHTML = `
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle me-2"></i>
                            Este espacio no tiene recursos disponibles.
                        </div>
                    `;
                    recursosContainer.style.display = 'block';
                    return;
                }

                // Crea checkboxes para cada recurso
                recursos.forEach(recurso => {
                    const div = document.createElement('div');
                    div.className = 'form-check mb-2';
                    
                    const checkbox = document.createElement('input');
                    checkbox.className = 'form-check-input';
                    checkbox.type = 'checkbox';
                    checkbox.name = 'recursos[]';
                    checkbox.value = recurso.id_recurso;
                    checkbox.id = `recurso_${recurso.id_recurso}`;
                    
                    const label = document.createElement('label');
                    label.className = 'form-check-label';
                    label.htmlFor = `recurso_${recurso.id_recurso}`;
                    
                    const nombreSpan = document.createElement('strong');
                    nombreSpan.textContent = recurso.nombre_recurso;
                    label.appendChild(nombreSpan);
                    
                    if (recurso.tipo) {
                        const tipoSpan = document.createElement('span');
                        tipoSpan.className = 'text-muted ms-2';
                        tipoSpan.textContent = `(${recurso.tipo})`;
                        label.appendChild(tipoSpan);
                    }
                    
                    div.appendChild(checkbox);
                    div.appendChild(label);
                    recursosList.appendChild(div);
                });

                // Mostra el contenedor de recursos
                recursosContainer.style.display = 'block';
            })
            .catch(error => {
                console.error('Error al cargar recursos:', error);
                recursosList.innerHTML = `
                    <div class="alert alert-danger mb-0">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Error al cargar los recursos. Por favor, intenta nuevamente.
                    </div>
                `;
                recursosContainer.style.display = 'block';
            });
    });

    // Oculta recursos al inicio
    recursosContainer.style.display = 'none';
});