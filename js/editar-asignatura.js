// Validación y manejo del formulario de editar asignatura
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form-editar-asignatura');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            // Validar que todos los campos requeridos estén completos
            const nombreAsignatura = form.querySelector('input[name="nombre_asignatura"]');
            const idDocente = form.querySelector('select[name="id_docente"]');
            const idGrupo = form.querySelector('select[name="id_grupo"]');
            
            let isValid = true;
            let errorMessage = '';
            
            // Validar nombre de asignatura
            if (!nombreAsignatura.value.trim()) {
                isValid = false;
                errorMessage += 'El nombre de la asignatura es requerido.\n';
            }
            
            // Validar selección de docente
            if (!idDocente.value) {
                isValid = false;
                errorMessage += 'Debe seleccionar un docente.\n';
            }
            
            // Validar selección de grupo
            if (!idGrupo.value) {
                isValid = false;
                errorMessage += 'Debe seleccionar un grupo.\n';
            }
            
            if (!isValid) {
                e.preventDefault();
                alert(errorMessage);
            }
        });
    }
});