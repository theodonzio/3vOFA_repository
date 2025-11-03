/** Muestra SOLO las clases del docente (no otras asignaturas) */

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

    /** Carga horarios del docente para el grupo seleccionado */
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

      // Muestra asignaturas del docente
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

      // Muestra estado de carga
      mensajeInicial.style.display = "none";
      tablaContainer.style.display = "none";
      estadoCarga.style.display = "block";

      try {
        // Obtiene información del grupo
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

        // Obtiene horarios del grupo
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

        // Construye tabla (SOLO MIS CLASES)
        console.log('Construyendo tabla con SOLO MIS CLASES...');
        construirTablaDocente(dataHorarios, asignaturas);

        // Muestra tabla
        estadoCarga.style.display = "none";
        tablaContainer.style.display = "block";
        
        console.log('✓ Carga completada exitosamente');

      } catch (error) {
        console.error('ERROR en cargarHorariosDocente:', error);
        estadoCarga.style.display = "none";
        
        // Muestra error con SweetAlert2 si está disponible
        if (typeof Swal !== 'undefined') {
          Swal.fire({
            icon: 'error',
            title: 'Error al cargar horarios',
            text: error.message,
            confirmButtonColor: '#dc3545'
          });
        } else {
          // Fallback si SweetAlert2 no está disponible
          alert('Error al cargar horarios: ' + error.message);
        }
        
        // Vuelve a mostrar mensaje inicial
        mensajeInicial.style.display = "block";
      }
    }

    /**
     * Construye tabla de horarios mostrando SOLO las clases del docente
     * @param {Object} datos - Datos de horarios del grupo
     * @param {string} misAsignaturas - String con las asignaturas del docente separadas por coma
     */
    function construirTablaDocente(datos, misAsignaturas) {
      console.log('Construyendo tabla SOLO con mis clases');
      
      // Limpia tabla
      tablaBody.innerHTML = '';

      // Convierte mis asignaturas a array
      const misAsignaturasArray = misAsignaturas ? misAsignaturas.split(', ') : [];
      console.log('Mis asignaturas:', misAsignaturasArray);

      // Organiza horarios por hora (SOLO MIS CLASES)
      const horariosPorHora = {};
      
      datos.horarios.forEach(h => {
        // FILTRA: Solo procesar si es una de mis asignaturas
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

      // Verifica si tengo clases
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

      // Ordena horarios
      const horariosOrdenados = Object.values(horariosPorHora).sort((a, b) => a.id - b.id);

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