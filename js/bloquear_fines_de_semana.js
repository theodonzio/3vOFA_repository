document.addEventListener('DOMContentLoaded', function () {
    const inputFecha = document.getElementById('fecha_reserva');
    if (!inputFecha) return;

    // No permitir seleccionar sábados o domingos
    inputFecha.addEventListener('input', function () {
        const fechaSeleccionada = new Date(this.value + 'T00:00:00');
        const dia = fechaSeleccionada.getDay(); // 0 = domingo, 6 = sábado

        if (dia === 0 || dia === 6) {
            Swal.fire({
                icon: 'warning',
                title: obtenerTraduccion('Día no disponible'),
                text: obtenerTraduccion('No se pueden realizar reservas los días sábado o domingo.'),
                confirmButtonColor: '#f0ad4e'
            });
            this.value = ''; // Limpia la fecha seleccionada
        }
    });

    // Evitar seleccionar fechas pasadas
    const hoy = new Date();
    const yyyy = hoy.getFullYear();
    const mm = String(hoy.getMonth() + 1).padStart(2, '0');
    const dd = String(hoy.getDate()).padStart(2, '0');
    inputFecha.min = `${yyyy}-${mm}-${dd}`;
});