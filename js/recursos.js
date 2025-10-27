// Confirmación de eliminación de recursos
document.addEventListener('DOMContentLoaded', function() {
    const botonesEliminar = document.querySelectorAll('.btn-eliminar');
    
    botonesEliminar.forEach(boton => {
        boton.addEventListener('click', function(e) {
            const nombreRecurso = this.getAttribute('data-nombre');
            const confirmar = confirm(`¿Seguro que deseas eliminar el recurso ${nombreRecurso}?`);
            
            if (!confirmar) {
                e.preventDefault();
            }
        });
    });
});