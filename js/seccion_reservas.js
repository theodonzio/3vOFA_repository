document.addEventListener('DOMContentLoaded', function() {
    function isDarkMode() {
        return document.body.classList.contains('oscuro');
    }

    document.querySelectorAll('.btn-aprobar-reserva').forEach(btn => {
        btn.addEventListener('click', function() {
            const idReserva = this.getAttribute('data-id');
            const docente = this.getAttribute('data-docente');
            const salon = this.getAttribute('data-salon');
            const fecha = this.getAttribute('data-fecha');
            const horario = this.getAttribute('data-horario');
            const recursos = this.getAttribute('data-recursos');

            const dark = isDarkMode();

            Swal.fire({
                title: '¿Aprobar esta reserva?',
                html: `
                    <div class="text-start">
                        <p><strong>Docente:</strong> ${docente}</p>
                        <p><strong>Salón:</strong> ${salon}</p>
                        <p><strong>Fecha:</strong> ${fecha}</p>
                        <p><strong>Horario:</strong> ${horario}</p>
                        <p><strong>Recursos:</strong> ${recursos}</p>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="bi bi-check-lg"></i> Sí, aprobar',
                cancelButtonText: '<i class="bi bi-x-lg"></i> Cancelar',
                background: dark ? '#2c2c2c' : '#fff',
                color: dark ? '#f5f5f5' : '#212529'
            }).then((result) => {
                if (result.isConfirmed) {
                    enviarAccion(idReserva, 'Aprobar');
                }
            });
        });
    });

    document.querySelectorAll('.btn-rechazar-reserva').forEach(btn => {
        btn.addEventListener('click', function() {
            const idReserva = this.getAttribute('data-id');
            const docente = this.getAttribute('data-docente');
            const salon = this.getAttribute('data-salon');
            const fecha = this.getAttribute('data-fecha');
            const horario = this.getAttribute('data-horario');
            const recursos = this.getAttribute('data-recursos');

            const dark = isDarkMode();

            Swal.fire({
                title: '¿Rechazar esta reserva?',
                html: `
                    <div class="text-start">
                        <p><strong>Docente:</strong> ${docente}</p>
                        <p><strong>Salón:</strong> ${salon}</p>
                        <p><strong>Fecha:</strong> ${fecha}</p>
                        <p><strong>Horario:</strong> ${horario}</p>
                        <p><strong>Recursos:</strong> ${recursos}</p>
                        <p class="text-danger mt-3"><small><i class="bi bi-exclamation-triangle"></i> Esta acción no se puede deshacer.</small></p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="bi bi-trash"></i> Sí, rechazar',
                cancelButtonText: '<i class="bi bi-x-lg"></i> Cancelar',
                background: dark ? '#2c2c2c' : '#fff',
                color: dark ? '#f5f5f5' : '#212529'
            }).then((result) => {
                if (result.isConfirmed) {
                    enviarAccion(idReserva, 'Rechazar');
                }
            });
        });
    });

    function enviarAccion(idReserva, accion) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '../funciones/aprobar_reserva.php';

        const inputId = document.createElement('input');
        inputId.type = 'hidden';
        inputId.name = 'id_reserva';
        inputId.value = idReserva;

        const inputAccion = document.createElement('input');
        inputAccion.type = 'hidden';
        inputAccion.name = 'accion';
        inputAccion.value = accion;

        const inputSweetAlert = document.createElement('input');
        inputSweetAlert.type = 'hidden';
        inputSweetAlert.name = 'use_sweetalert';
        inputSweetAlert.value = '1';

        form.appendChild(inputId);
        form.appendChild(inputAccion);
        form.appendChild(inputSweetAlert);
        document.body.appendChild(form);
        form.submit();
    }
});