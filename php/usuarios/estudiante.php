<?php
// Guardar id_grupo ANTES de incluir cualquier cosa
$id_grupo_actual = isset($_GET['id_grupo']) ? intval($_GET['id_grupo']) : 0;

include '../tools/head.php';
include '../login/conexion_bd.php';
include '../tools/headers/header_estudiante.php';
?>

<link rel="stylesheet" href="../../css/style.css">

<body>

<div class="container text-center my-5">
    <div class="mb-4">
        <i class="bi bi-calendar-week" style="font-size: 4rem; color: #0d6efd;"></i>
    </div>
    <h1 class="display-4 fw-bold text-primary mb-3" id="tituloGrupo">Cargando...</h1>
    <p class="lead text-muted mb-4" id="subtituloGrupo">Aquí verás tu horario académico</p>
    <div id="watch" class="reloj text-center mt-2 fs-4 fw-semibold text-primary"></div>
</div>

<div class="container my-5">
  <div id="tablaHorariosContainer" style="display: none;">
    <div class="table-responsive shadow rounded">
      <table class="table table-bordered text-center align-middle table-hover mb-0">
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
        <tbody id="cuerpoTabla"></tbody>
      </table>
    </div>
  </div>

  <div id="mensajeVacio" class="text-center py-5">
    <i class="bi bi-calendar-event display-1 text-muted mb-3"></i>
    <p class="fs-5 text-muted">Selecciona un grupo para ver tu horario</p>
  </div>
</div>

<?php include '../tools/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/traductor.js"></script>
<script src="../../js/modoClaroOscuro.js"></script>
<script src="../../js/scroll-top.js"></script>
<script src="../../js/watchFunction.js"></script>

<script>
console.log('=== PÁGINA ESTUDIANTE CARGADA ===');

document.addEventListener('DOMContentLoaded', async () => {
  const params = new URLSearchParams(window.location.search);
  const idGrupo = params.get('id_grupo');

  console.log('ID Grupo recibido:', idGrupo);

  if (!idGrupo) {
    document.getElementById('tituloGrupo').textContent = 'Selecciona tu grupo';
    document.getElementById('subtituloGrupo').textContent = 'Debes seleccionar un grupo desde la página de inicio';
    document.getElementById('mensajeVacio').style.display = 'block';
    return;
  }

  try {
    // Cargar info del grupo
    console.log('1. Cargando información del grupo...');
    const responseGrupo = await fetch(`../funciones/obtener_info_grupo.php?id_grupo=${idGrupo}`);
    
    if (!responseGrupo.ok) {
      throw new Error(`HTTP ${responseGrupo.status}: Error al cargar información del grupo`);
    }
    
    const textGrupo = await responseGrupo.text();
    console.log('Respuesta info grupo (raw):', textGrupo);
    
    const dataGrupo = JSON.parse(textGrupo);
    console.log('Info del grupo:', dataGrupo);
    
    if (dataGrupo.nombre_grupo) {
      document.getElementById('tituloGrupo').textContent = `Grupo ${dataGrupo.nombre_grupo}`;
      document.getElementById('subtituloGrupo').textContent = dataGrupo.nombre_curso || 'Tu horario académico';
    }

    // Cargar horarios
    console.log('2. Cargando horarios del grupo...');
    const response = await fetch(`../funciones/obtener_horario_estudiante.php?id_grupo=${idGrupo}`);
    
    if (!response.ok) {
      throw new Error(`HTTP ${response.status}: Error al cargar horarios`);
    }
    
    const text = await response.text();
    console.log('Respuesta horarios (raw):', text);
    
    const data = JSON.parse(text);
    console.log('Datos parseados:', data);

    if (data.error) {
      throw new Error(data.error);
    }

    if (!data.horarios || data.horarios.length === 0) {
      document.getElementById('mensajeVacio').innerHTML = `
        <i class="bi bi-calendar-x display-1 text-warning mb-3"></i>
        <p class="fs-5 text-muted">Este grupo no tiene horarios asignados aún</p>
        <p class="text-muted small">Contacta a la adscripta para configurar los horarios</p>
      `;
      document.getElementById('mensajeVacio').style.display = 'block';
      return;
    }

    console.log('3. Construyendo tabla...');
    construirTabla(data);
    document.getElementById('tablaHorariosContainer').style.display = 'block';
    document.getElementById('mensajeVacio').style.display = 'none';
    console.log('✓ Tabla mostrada correctamente');

  } catch (error) {
    console.error('ERROR:', error);
    mostrarError(error.message);
  }
});

function construirTabla(datos) {
  const tbody = document.getElementById('cuerpoTabla');
  tbody.innerHTML = '';

  // Organizar horarios por hora
  const horariosPorHora = {};
  
  datos.horarios.forEach(h => {
    if (!horariosPorHora[h.id_horario]) {
      horariosPorHora[h.id_horario] = {
        id: h.id_horario,
        nombre: h.nombre_horario,
        horas: h.hora_inicio + ' - ' + h.hora_fin,
        dias: {}
      };
    }
    if (h.nombre_asignatura) {
      horariosPorHora[h.id_horario].dias[h.dia_semana] = h.nombre_asignatura;
    }
  });

  // Ordenar horarios por ID
  const horariosOrdenados = Object.values(horariosPorHora).sort((a, b) => a.id - b.id);
  console.log('Horarios ordenados:', horariosOrdenados);

  // Construir filas
  horariosOrdenados.forEach(horario => {
    const tr = document.createElement('tr');
    
    // Columna de hora
    const tdHora = document.createElement('td');
    tdHora.className = 'fw-bold bg-light';
    tdHora.innerHTML = `
      <strong>${horario.nombre}</strong><br>
      <small class="text-muted">${horario.horas}</small>
    `;
    tr.appendChild(tdHora);
    
    // 5 columnas para días (1=Lunes, 2=Martes, etc.)
    for (let dia = 1; dia <= 5; dia++) {
      const td = document.createElement('td');
      const asignatura = horario.dias[dia];
      
      if (asignatura) {
        td.innerHTML = `<span class="badge bg-primary fs-6 p-2 w-100">${asignatura}</span>`;
      } else {
        td.innerHTML = '<span class="text-muted">—</span>';
      }
      
      tr.appendChild(td);
    }
    
    tbody.appendChild(tr);
  });

  console.log('✓ Tabla construida:', horariosOrdenados.length, 'filas');
}

function mostrarError(mensaje) {
  document.getElementById('tituloGrupo').textContent = 'Error al cargar';
  document.getElementById('subtituloGrupo').textContent = '';
  document.getElementById('mensajeVacio').innerHTML = `
    <i class="bi bi-exclamation-circle display-1 text-danger mb-3"></i>
    <p class="fs-5 text-danger fw-bold">${mensaje}</p>
    <button class="btn btn-primary mt-3" onclick="location.reload()">
      <i class="bi bi-arrow-clockwise me-2"></i>Reintentar
    </button>
  `;
  document.getElementById('mensajeVacio').style.display = 'block';
}
</script>

<style>
/* Estilos para la tabla */
.table {
  border-radius: 10px;
  overflow: hidden;
}

.table thead th {
  font-weight: 700;
  font-size: 1rem;
  vertical-align: middle;
  padding: 1rem;
  background-color: #0d6efd !important;
  color: white !important;
}

.table tbody td {
  vertical-align: middle;
  padding: 1rem;
}

.table tbody tr {
  transition: background-color 0.2s;
}

.table tbody tr:hover {
  background-color: rgba(13, 110, 253, 0.1);
}

.badge {
  font-weight: 600;
  letter-spacing: 0.3px;
  white-space: normal;
  line-height: 1.4;
}

/* Modo oscuro */
body.oscuro .table {
  background-color: #2b2b2b;
  color: #f5f5f5;
}

body.oscuro .table thead th {
  background-color: #1565c0 !important;
}

body.oscuro .table tbody td {
  background-color: #3a3a3a;
  color: #f5f5f5;
  border-color: #555;
}

body.oscuro .table tbody tr:hover {
  background-color: #505050;
}

body.oscuro .bg-light {
  background-color: #3a3a3a !important;
  color: #f5f5f5 !important;
}

body.oscuro .text-muted {
  color: #adb5bd !important;
}

/* Responsive */
@media (max-width: 768px) {
  .table {
    font-size: 0.875rem;
  }
  
  .table thead th,
  .table tbody td {
    padding: 0.5rem 0.25rem;
  }
  
  .badge {
    font-size: 0.75rem;
    padding: 0.35rem 0.5rem;
  }
}

/* Animación */
#tablaHorariosContainer {
  animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>

</body>
</html>