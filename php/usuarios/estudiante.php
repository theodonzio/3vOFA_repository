<?php
  include '../tools/head.php';
  include '../tools/headers/header_estudiante.php';
  include '../login/conexion_bd.php';
?>

<link rel="stylesheet" href="../../css/style.css">

<div class="container my-5">
  <!-- Título del Grupo Seleccionado -->
  <div class="text-center mb-5">
    <h1 class="display-5 fw-bold text-primary" id="tituloGrupo">Selecciona tu grupo</h1>
    <p class="text-muted fs-5" id="subtituloGrupo">Aquí verás tu horario académico</p>
  </div>

  <!-- Tabla de Horarios -->
  <div id="tablaHorariosContainer" style="display: none;">
    <div class="table-responsive">
      <table class="table table-bordered text-center align-middle table-hover table-striped">
        <thead class="table-primary">
          <tr>
            <th style="width: 15%;">Hora</th>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miércoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
          </tr>
        </thead>
        <tbody id="cuerpoTabla">
          <!-- Los datos se cargarán aquí dinámicamente -->
        </tbody>
      </table>
    </div>
  </div>

  <!-- Mensaje cuando no hay grupo seleccionado -->
  <div id="mensajeVacio" class="text-center py-5">
    <i class="bi bi-calendar-event display-1 text-muted mb-3"></i>
    <p class="fs-5 text-muted">Selecciona un grupo en la página anterior para ver tu horario</p>
  </div>
</div>

<!-- Botón scroll top -->
<a href="#top" id="scrollTopBtn" class="btn btn-secondary shadow-lg position-fixed bottom-0 end-0 m-4" 
   style="z-index:999; font-size:28px; opacity:0; transform: translateY(20px); transition: opacity 0.5s, transform 0.5s;">
  <i class="bi bi-caret-up-fill"></i>
</a>

<?php include '../tools/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/traductor.js"></script>
<script src="../../js/modoClaroOscuro.js"></script>
<script src="../../js/scroll-top.js"></script>

<script>
document.addEventListener('DOMContentLoaded', async () => {
  // Obtener el parámetro 'opcion' de la URL
  const params = new URLSearchParams(window.location.search);
  const opcionGrupo = params.get('opcion');

  if (!opcionGrupo) {
    document.getElementById('mensajeVacio').style.display = 'block';
    document.getElementById('tablaHorariosContainer').style.display = 'none';
    return;
  }

  // Mapeo de opciones a id_grupo
  const grupoMap = {
    '1MC': 1,
    '1MD': 1,
    '2MA': 2,
    '2MB': 2,
    '2MD': 2,
    '3MA': 3,
    '3MB': 3,
    '3MD': 3,
    '3BA': 4
  };

  const idGrupo = grupoMap[opcionGrupo];

  if (!idGrupo) {
    document.getElementById('mensajeVacio').style.display = 'block';
    return;
  }

  // Actualizar título
  document.getElementById('tituloGrupo').textContent = `Horario - Grupo ${opcionGrupo}`;
  document.getElementById('subtituloGrupo').textContent = 'Tu programa académico de la semana';

  // Cargar horarios desde el servidor
  try {
    const response = await fetch(`../funciones/obtener_horario_estudiante.php?id_grupo=${idGrupo}`);
    const data = await response.json();

    if (data.error) {
      console.error('Error:', data.error);
      document.getElementById('mensajeVacio').style.display = 'block';
      return;
    }

    // Construir tabla
    construirTabla(data);
    document.getElementById('tablaHorariosContainer').style.display = 'block';
    document.getElementById('mensajeVacio').style.display = 'none';

  } catch (error) {
    console.error('Error al cargar horarios:', error);
    document.getElementById('mensajeVacio').style.display = 'block';
  }
});

function construirTabla(datos) {
  const tbody = document.getElementById('cuerpoTabla');
  tbody.innerHTML = '';

  // Agrupar por horario
  const horariosPorHora = {};
  
  datos.horarios.forEach(h => {
    if (!horariosPorHora[h.id_horario]) {
      horariosPorHora[h.id_horario] = {
        nombre: h.nombre_horario,
        horas: h.hora_inicio + ' - ' + h.hora_fin,
        dias: {}
      };
    }
    if (h.nombre_asignatura) {
      horariosPorHora[h.id_horario].dias[h.dia_semana] = h.nombre_asignatura;
    }
  });

  // Crear filas
  Object.values(horariosPorHora).forEach(horario => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td class="fw-bold bg-light">
        <strong>${horario.nombre}</strong><br>
        <small class="text-muted">${horario.horas}</small>
      </td>
      ${[1, 2, 3, 4, 5].map(dia => {
        const asignatura = horario.dias[dia];
        return `<td>${asignatura ? `<span class="badge bg-info text-dark">${asignatura}</span>` : '<span class="text-muted">—</span>'}</td>`;
      }).join('')}
    `;
    tbody.appendChild(tr);
  });
}
</script>

</body>
</html>