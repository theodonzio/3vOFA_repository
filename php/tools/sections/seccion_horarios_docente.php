<?php
/**
 * Sección de Horarios para Docentes
 * Muestra SOLO las clases del docente (no otras asignaturas)
 */

// Obtener ID del docente de la sesión
$id_docente_actual = $_SESSION['id_usuario'];
?>

<div class="container my-5" id="HorariosDocente">
  <h2 class="text-center mb-4">
    <i class="bi bi-calendar-week me-2"></i>
    <span data-traducible="Mis Horarios">Mis Horarios</span>
  </h2>
  
  <p class="text-center text-muted mb-4">
    <span data-traducible="Selecciona un grupo para ver tu horario de clases">
      Selecciona un grupo para ver tu horario de clases
    </span>
  </p>

  <!-- Selector de Grupo -->
  <div class="d-flex justify-content-center mb-4">
    <div class="card shadow-sm" style="max-width: 500px; width: 100%;">
      <div class="card-body">
        <label for="grupoSelectDocente" class="form-label fw-bold">
          <i class="bi bi-people-fill me-2"></i>
          <span data-traducible="Seleccionar grupo:">Seleccionar grupo:</span>
        </label>
        <select id="grupoSelectDocente" class="form-select form-select-lg">
          <option value="" data-traducible="-- Seleccionar grupo --">-- Seleccionar grupo --</option>
          <?php
          if (isset($conn)) {
              // Obtener grupos donde el docente está asignado
              $sql = "SELECT DISTINCT g.id_grupo, g.nombre_grupo, c.nombre_curso, t.nombre_turno,
                             GROUP_CONCAT(DISTINCT a.nombre_asignatura SEPARATOR ', ') as asignaturas
                      FROM grupo_asignatura ga
                      JOIN grupo g ON ga.id_grupo = g.id_grupo
                      LEFT JOIN curso c ON g.id_curso = c.id_curso
                      LEFT JOIN turno t ON g.id_turno = t.id_turno
                      JOIN asignatura a ON ga.id_asignatura = a.id_asignatura
                      WHERE ga.id_docente = ?
                      GROUP BY g.id_grupo, g.nombre_grupo, c.nombre_curso, t.nombre_turno
                      ORDER BY g.nombre_grupo";
              
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("i", $id_docente_actual);
              $stmt->execute();
              $result = $stmt->get_result();
              
              if ($result->num_rows > 0) {
                  while ($g = $result->fetch_assoc()) {
                      $nombreCompleto = htmlspecialchars($g['nombre_grupo']);
                      if ($g['nombre_curso']) {
                          $nombreCompleto .= " - " . htmlspecialchars($g['nombre_curso']);
                      }
                      if ($g['nombre_turno']) {
                          $nombreCompleto .= " (" . htmlspecialchars($g['nombre_turno']) . ")";
                      }
                      
                      echo "<option value='{$g['id_grupo']}' 
                                    data-asignaturas='" . htmlspecialchars($g['asignaturas']) . "'>
                              {$nombreCompleto}
                            </option>";
                  }
              } else {
                  echo "<option value='' disabled>No estás asignado a ningún grupo</option>";
              }
              
              $stmt->close();
          }
          ?>
        </select>
        
        <!-- Mostrar asignaturas del docente en este grupo -->
        <div id="asignaturasDocente" class="mt-3" style="display: none;">
          <div class="alert alert-success mb-0">
            <strong><i class="bi bi-book me-2"></i>Tus asignaturas en este grupo:</strong>
            <p id="listadoAsignaturas" class="mb-0 mt-2"></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Estado de carga -->
  <div id="estadoCargaDocente" class="text-center" style="display: none;">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Cargando...</span>
    </div>
    <p class="mt-2">Cargando horarios...</p>
  </div>

  <!-- Tabla de Horarios -->
  <div id="contenedorTablaHorariosDocente" style="display: none;">
    <div class="alert alert-info mb-3">
      <i class="bi bi-info-circle me-2"></i>
      <strong>Grupo:</strong> <span id="infoGrupoDocente"></span> | 
      <strong>Curso:</strong> <span id="infoCursoDocente"></span>
    </div>

    <div class="table-responsive shadow rounded">
      <table class="table table-bordered text-center align-middle table-hover mb-0">
        <thead class="table-success">
          <tr>
            <th style="width: 15%;" data-traducible="Hora">Hora</th>
            <th data-traducible="Lunes">Lunes</th>
            <th data-traducible="Martes">Martes</th>
            <th data-traducible="Miércoles">Miércoles</th>
            <th data-traducible="Jueves">Jueves</th>
            <th data-traducible="Viernes">Viernes</th>
          </tr>
        </thead>
        <tbody id="cuerpoTablaHorariosDocente">
          <!-- Se llenará dinámicamente -->
        </tbody>
      </table>
    </div>

    <!-- Leyenda -->
    <div class="mt-3 text-center">
      <small class="text-muted">
        <i class="bi bi-info-circle me-1"></i>
        Solo se muestran tus clases asignadas
      </small>
    </div>
  </div>
  
  <div id="mensajeInicialHorariosDocente" class="text-center text-muted mt-4">
    <i class="bi bi-arrow-up-circle fs-1"></i>
    <p class="mt-2">
      <span data-traducible="Selecciona un grupo para ver tus horarios">
        Selecciona un grupo para ver tus horarios
      </span>
    </p>
  </div>
</div>

<script>
(function() {
  'use strict';
  
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', inicializarHorariosDocente);
  } else {
    inicializarHorariosDocente();
  }

  function inicializarHorariosDocente() {
    console.log('=== INICIALIZANDO HORARIOS DOCENTE (SOLO MIS CLASES) ===');
    
    const grupoSelect = document.getElementById("grupoSelectDocente");
    const tablaContainer = document.getElementById("contenedorTablaHorariosDocente");
    const mensajeInicial = document.getElementById("mensajeInicialHorariosDocente");
    const estadoCarga = document.getElementById("estadoCargaDocente");
    const tablaBody = document.getElementById("cuerpoTablaHorariosDocente");
    const infoGrupo = document.getElementById("infoGrupoDocente");
    const infoCurso = document.getElementById("infoCursoDocente");
    const asignaturasDiv = document.getElementById("asignaturasDocente");
    const listadoAsignaturas = document.getElementById("listadoAsignaturas");

    if (!grupoSelect || !tablaBody) {
      console.error('ERROR: No se encontraron todos los elementos necesarios');
      return;
    }

    console.log('✓ Elementos encontrados correctamente');

    // Event listener para el selector de grupo
    grupoSelect.addEventListener("change", cargarHorariosDocente);

    async function cargarHorariosDocente() {
      const idGrupo = grupoSelect.value;
      console.log('Grupo seleccionado:', idGrupo);

      if (!idGrupo) {
        tablaContainer.style.display = "none";
        mensajeInicial.style.display = "block";
        estadoCarga.style.display = "none";
        asignaturasDiv.style.display = "none";
        return;
      }

      // Mostrar asignaturas del docente
      const opcionSeleccionada = grupoSelect.options[grupoSelect.selectedIndex];
      const asignaturas = opcionSeleccionada.getAttribute('data-asignaturas');
      
      if (asignaturas) {
        const asignaturasArray = asignaturas.split(', ');
        let badgesHtml = '';
        asignaturasArray.forEach(asig => {
          badgesHtml += `<span class="badge bg-success me-1 mb-1">${asig}</span>`;
        });
        listadoAsignaturas.innerHTML = badgesHtml;
        asignaturasDiv.style.display = "block";
      }

      // Mostrar estado de carga
      mensajeInicial.style.display = "none";
      tablaContainer.style.display = "none";
      estadoCarga.style.display = "block";

      try {
        // Obtener información del grupo
        console.log('Obteniendo información del grupo...');
        const urlInfo = `../funciones/obtener_info_grupo.php?id_grupo=${idGrupo}&t=${Date.now()}`;
        const respInfo = await fetch(urlInfo);
        
        if (!respInfo.ok) {
          throw new Error(`HTTP ${respInfo.status}: Error al cargar información del grupo`);
        }
        
        const dataInfo = await respInfo.json();
        console.log('✓ Info del grupo:', dataInfo);
        
        if (dataInfo.nombre_grupo) {
          infoGrupo.textContent = dataInfo.nombre_grupo;
          infoCurso.textContent = dataInfo.nombre_curso || 'N/A';
        }

        // Obtener horarios del grupo
        console.log('Obteniendo horarios del grupo...');
        const urlHorarios = `../funciones/obtener_horario_estudiante.php?id_grupo=${idGrupo}&t=${Date.now()}`;
        const respHorarios = await fetch(urlHorarios);
        
        if (!respHorarios.ok) {
          throw new Error(`HTTP ${respHorarios.status}: Error al cargar horarios`);
        }
        
        const dataHorarios = await respHorarios.json();
        console.log('✓ Horarios obtenidos:', dataHorarios);

        if (dataHorarios.error) {
          throw new Error(dataHorarios.error);
        }

        if (!dataHorarios.horarios || dataHorarios.horarios.length === 0) {
          throw new Error('Este grupo no tiene horarios asignados');
        }

        // Construir tabla (SOLO MIS CLASES)
        console.log('Construyendo tabla con SOLO MIS CLASES...');
        construirTablaDocente(dataHorarios, asignaturas);

        // Mostrar tabla
        estadoCarga.style.display = "none";
        tablaContainer.style.display = "block";
        
        console.log('✓ Carga completada exitosamente');

      } catch (error) {
        console.error('ERROR en cargarHorariosDocente:', error);
        estadoCarga.style.display = "none";
        
        Swal.fire({
          icon: 'error',
          title: 'Error al cargar horarios',
          text: error.message,
          confirmButtonColor: '#dc3545'
        });
      }
    }

    function construirTablaDocente(datos, misAsignaturas) {
      console.log('Construyendo tabla SOLO con mis clases');
      
      // Limpiar tabla
      tablaBody.innerHTML = '';

      // Convertir mis asignaturas a array
      const misAsignaturasArray = misAsignaturas ? misAsignaturas.split(', ') : [];
      console.log('Mis asignaturas:', misAsignaturasArray);

      // Organizar horarios por hora (SOLO MIS CLASES)
      const horariosPorHora = {};
      
      datos.horarios.forEach(h => {
        // ✅ FILTRAR: Solo procesar si es una de mis asignaturas
        if (h.nombre_asignatura && misAsignaturasArray.includes(h.nombre_asignatura)) {
          if (!horariosPorHora[h.id_horario]) {
            horariosPorHora[h.id_horario] = {
              id: h.id_horario,
              nombre: h.nombre_horario,
              horas: h.hora_inicio + ' - ' + h.hora_fin,
              dias: {}
            };
          }
          
          horariosPorHora[h.id_horario].dias[h.dia_semana] = h.nombre_asignatura;
        }
      });

      // Verificar si tengo clases
      if (Object.keys(horariosPorHora).length === 0) {
        tablaBody.innerHTML = `
          <tr>
            <td colspan="6" class="text-center py-5">
              <i class="bi bi-info-circle fs-1 text-muted d-block mb-3"></i>
              <p class="text-muted">No tienes clases asignadas en este grupo</p>
            </td>
          </tr>
        `;
        return;
      }

      // Ordenar horarios
      const horariosOrdenados = Object.values(horariosPorHora).sort((a, b) => a.id - b.id);

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
        
        // 5 columnas para días
        for (let dia = 1; dia <= 5; dia++) {
          const td = document.createElement('td');
          const asignatura = horario.dias[dia];
          
          if (asignatura) {
            td.innerHTML = `<span class="badge bg-success fs-6 p-2 w-100">
              <i class="bi bi-book me-1"></i>${asignatura}
            </span>`;
          } else {
            td.innerHTML = '<span class="text-muted">—</span>';
          }
          
          tr.appendChild(td);
        }
        
        tablaBody.appendChild(tr);
      });

      console.log('✓ Tabla construida con', horariosOrdenados.length, 'bloques horarios (SOLO MIS CLASES)');
    }

    console.log('✓ Horarios docente inicializados correctamente');
  }
})();
</script>

<style>
/* Estilos para la tabla de horarios docente */
#contenedorTablaHorariosDocente .table {
  border-radius: 10px;
  overflow: hidden;
}

#contenedorTablaHorariosDocente .table thead th {
  font-weight: 700;
  font-size: 1rem;
  vertical-align: middle;
  padding: 1rem;
  background-color: #198754 !important;
  color: white !important;
}

#contenedorTablaHorariosDocente .table tbody td {
  vertical-align: middle;
  padding: 1rem;
}

#contenedorTablaHorariosDocente .table tbody tr {
  transition: background-color 0.2s;
}

#contenedorTablaHorariosDocente .table tbody tr:hover {
  background-color: rgba(25, 135, 84, 0.1);
}

#contenedorTablaHorariosDocente .badge {
  font-weight: 600;
  letter-spacing: 0.3px;
  white-space: normal;
  line-height: 1.4;
}

/* Modo oscuro */
body.oscuro #contenedorTablaHorariosDocente .table {
  background-color: #2b2b2b;
  color: #f5f5f5;
}

body.oscuro #contenedorTablaHorariosDocente .table thead th {
  background-color: #157347 !important;
}

body.oscuro #contenedorTablaHorariosDocente .table tbody td {
  background-color: #3a3a3a;
  color: #f5f5f5;
  border-color: #555;
}

body.oscuro #contenedorTablaHorariosDocente .table tbody tr:hover {
  background-color: #505050;
}

body.oscuro #contenedorTablaHorariosDocente .bg-light {
  background-color: #3a3a3a !important;
  color: #f5f5f5 !important;
}

body.oscuro .alert-info {
  background-color: #2c3e50 !important;
  border-color: #34495e !important;
  color: #ecf0f1 !important;
}

body.oscuro .alert-success {
  background-color: #1e4d2b !important;
  border-color: #2d5a37 !important;
  color: #d4edda !important;
}

/* Responsive */
@media (max-width: 768px) {
  #contenedorTablaHorariosDocente .table {
    font-size: 0.875rem;
  }
  
  #contenedorTablaHorariosDocente .table thead th,
  #contenedorTablaHorariosDocente .table tbody td {
    padding: 0.5rem 0.25rem;
  }
  
  #contenedorTablaHorariosDocente .badge {
    font-size: 0.75rem;
    padding: 0.35rem 0.5rem;
  }
}

/* Animación */
#contenedorTablaHorariosDocente {
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