// Inicialización de tooltips y confirmación de eliminación
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar tooltips de Bootstrap
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));

    // Confirmación de eliminación de grupos
    const botonesEliminar = document.querySelectorAll('.btn-eliminar');
    
    botonesEliminar.forEach(boton => {
        boton.addEventListener('click', function(e) {
            const nombreGrupo = this.getAttribute('data-nombre');
            const confirmar = confirm(`¿Seguro que deseas eliminar el grupo ${nombreGrupo}?`);
            
            if (!confirmar) {
                e.preventDefault();
            }
        });
    });
});