/** Script para cargar y mostrar horarios del estudiante */

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
    // Cargar información del grupo
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

/**
   Construye tabla de horarios
   @param {Object} datos - Datos de horarios del estudiante
 */
function construirTabla(datos) {
  const tbody = document.getElementById('cuerpoTabla');
  tbody.innerHTML = '';

  // Organiza horarios por hora
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

  // Ordena horarios por ID
  const horariosOrdenados = Object.values(horariosPorHora).sort((a, b) => a.id - b.id);
  console.log('Horarios ordenados:', horariosOrdenados);

  // Construye filas
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
    
    // Las 5 columnas para cada día 
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

/**
  Muestra mensaje de error
  @param {string} mensaje 
 */
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