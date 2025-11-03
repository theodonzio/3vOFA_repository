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
                title: 'Día no disponible',
                text: 'No se pueden realizar reservas los días sábado o domingo.',
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

    // 👇 "Hack" visual para ocultar sábados y domingos en el calendario (solo Chrome / Edge)
    inputFecha.addEventListener('click', () => {
        // Esperar a que se abra el calendario (no hay API oficial)
        setTimeout(() => {
            const estilo = document.createElement('style');
            estilo.innerHTML = `
                /* Ocultar fines de semana en el selector de fecha */
                ::-webkit-datetime-edit-fields-wrapper {
                    background-color: white !important;
                }
                /* No hay forma estándar de ocultar días, pero algunos navegadores aplican filtros */
                input[type="date"]::-webkit-calendar-picker-indicator {
                    filter: hue-rotate(180deg) brightness(0.7);
                }
            `;
            document.head.appendChild(estilo);
        }, 100);
    });
});
