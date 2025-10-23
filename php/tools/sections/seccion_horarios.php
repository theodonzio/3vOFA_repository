<style>
/* FORZAR VISIBILIDAD DE LA TABLA */
#contenedorTablaHorarios {
  display: block !important;
}

#tablaHorarios {
  display: table !important;
  visibility: visible !important;
  width: 100% !important;
}

#cuerpoTablaHorarios {
  display: table-row-group !important;
  visibility: visible !important;
}

#cuerpoTablaHorarios tr {
  display: table-row !important;
  visibility: visible !important;
}

#cuerpoTablaHorarios td {
  display: table-cell !important;
  visibility: visible !important;
}
</style>

<div class="container my-5">
  <h2 class="text-center mb-4" id="GestionHorarios">
    <span data-traducible="Gestión de Horarios por Grupo">Gestión de Horarios por Grupo</span>
  </h2>
  
  <p class="text-center text-muted mb-4">
    <span data-traducible="Seleccioná un grupo para asignarle horarios y materias">Seleccioná un grupo para asignarle horarios y materias</span>
  </p>

  <!-- Selector de Grupo -->
  <div class="d-flex justify-content-center mb-4">
    <div class="card shadow-sm" style="max-width: 500px; width: 100%;">
      <div class="card-body">
        <label for="grupoSelectHorarios" class="form-label fw-bold">
          <i class="bi bi-people-fill me-2"></i>
          <span data-traducible="Seleccionar grupo:">Seleccionar grupo:</span>
        </label>
        <select id="grupoSelectHorarios" class="form-select form-select-lg">
          <option value="" data-traducible="-- Seleccionar grupo --">-- Seleccionar grupo --</option>
          <?php
          if (isset($conn)) {
            $resGr = $conn->query("SELECT g.id_grupo, g.nombre_grupo, c.nombre_curso 
                                   FROM grupo g 
                                   LEFT JOIN curso c ON g.id_curso = c.id_curso 
                                   ORDER BY g.nombre_grupo");
            while ($g = $resGr->fetch_assoc()) {
              $nombreCompleto = $g['nombre_grupo'];
              if ($g['nombre_curso']) {
                $nombreCompleto .= " - " . $g['nombre_curso'];
              }
              echo "<option value='{$g['id_grupo']}'>{$nombreCompleto}</option>";
            }
          }
          ?>
        </select>
      </div>
    </div>
  </div>

  <!-- Estado de carga -->
  <div id="estadoCarga" class="text-center" style="display: none;">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Cargando...</span>
    </div>
    <p class="mt-2">Cargando horarios...</p>
  </div>

  <!-- Tabla de Horarios -->
  <div id="contenedorTablaHorarios" style="display: none;">
    <div class="alert alert-info mb-3">
      <i class="bi bi-info-circle me-2"></i>
      <strong>Grupo:</strong> <span id="infoGrupo"></span> | 
      <strong>Horarios disponibles:</strong> <span id="cantidadHorarios"></span> | 
      <strong>Asignaturas:</strong> <span id="cantidadAsignaturas"></span>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered text-center align-middle table-hover" id="tablaHorarios">
        <thead class="table-primary">
          <tr>
            <th style="width: 15%;" data-traducible="Hora">Hora</th>
            <th data-traducible="Lunes">Lunes</th>
            <th data-traducible="Martes">Martes</th>
            <th data-traducible="Miércoles">Miércoles</th>
            <th data-traducible="Jueves">Jueves</th>
            <th data-traducible="Viernes">Viernes</th>
          </tr>
        </thead>
        <tbody id="cuerpoTablaHorarios">
          <!-- Se llenará dinámicamente -->
        </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-center gap-3 mt-4">
      <button id="limpiarHorarios" class="btn btn-outline-secondary btn-lg px-4">
        <i class="bi bi-eraser me-2"></i>
        <span data-traducible="Limpiar Todo">Limpiar Todo</span>
      </button>
      <button id="guardarCambiosHorarios" class="btn btn-success btn-lg px-5">
        <i class="bi bi-save me-2"></i>
        <span data-traducible="Guardar Cambios">Guardar Cambios</span>
      </button>
    </div>
  </div>
  
  <div id="mensajeInicialHorarios" class="text-center text-muted mt-4">
    <i class="bi bi-arrow-up-circle fs-1"></i>
    <p class="mt-2">
      <span data-traducible="Seleccioná un grupo para comenzar">Seleccioná un grupo para comenzar</span>
    </p>
  </div>
</div>

<script>
(function() {
  'use strict';
  
  // Esperar a que el DOM esté completamente cargado
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', inicializarGestionHorarios);
  } else {
    inicializarGestionHorarios();
  }

  function inicializarGestionHorarios() {
    console.log('=== INICIALIZANDO GESTIÓN DE HORARIOS ===');
    
    const grupoSelect = document.getElementById("grupoSelectHorarios");
    const guardarBtn = document.getElementById("guardarCambiosHorarios");
    const limpiarBtn = document.getElementById("limpiarHorarios");
    const tablaContainer = document.getElementById("contenedorTablaHorarios");
    const mensajeInicial = document.getElementById("mensajeInicialHorarios");
    const estadoCarga = document.getElementById("estadoCarga");
    const tablaBody = document.getElementById("cuerpoTablaHorarios");
    const infoGrupo = document.getElementById("infoGrupo");
    const cantidadHorarios = document.getElementById("cantidadHorarios");
    const cantidadAsignaturas = document.getElementById("cantidadAsignaturas");

    // Verificar que todos los elementos existen
    if (!grupoSelect || !guardarBtn || !limpiarBtn || !tablaBody) {
      console.error('ERROR: No se encontraron todos los elementos necesarios');
      return;
    }

    console.log('✓ Elementos encontrados correctamente');

    // Variables globales
    let asignaturasGrupo = [];
    let horariosPermitidos = [];
    let grupoActual = null;

    // Event listener para el selector de grupo
    grupoSelect.addEventListener("change", cargarDatosGrupo);
    guardarBtn.addEventListener("click", guardarCambios);
    limpiarBtn.addEventListener("click", limpiarTodo);

    async function cargarDatosGrupo() {
      const idGrupo = grupoSelect.value;
      console.log('Grupo seleccionado:', idGrupo);

      if (!idGrupo) {
        tablaContainer.style.display = "none";
        mensajeInicial.style.display = "block";
        estadoCarga.style.display = "none";
        return;
      }

      // Mostrar estado de carga
      mensajeInicial.style.display = "none";
      tablaContainer.style.display = "none";
      estadoCarga.style.display = "block";

      try {
        // 1. Obtener horarios del curso
        console.log('Obteniendo horarios del curso...');
        const urlHorarios = `../funciones/obtener_horarios_curso.php?id_grupo=${idGrupo}&t=${Date.now()}`;
        console.log('URL:', urlHorarios);
        
        const respHorarios = await fetch(urlHorarios);
        
        if (!respHorarios.ok) {
          throw new Error(`HTTP ${respHorarios.status}: ${respHorarios.statusText}`);
        }
        
        const textHorarios = await respHorarios.text();
        console.log('Respuesta horarios (raw):', textHorarios);
        
        try {
          horariosPermitidos = JSON.parse(textHorarios);
        } catch (e) {
          console.error('Error parseando JSON:', e);
          throw new Error('La respuesta del servidor no es JSON válido');
        }
        
        console.log('✓ Horarios obtenidos:', horariosPermitidos);

        if (!Array.isArray(horariosPermitidos) || horariosPermitidos.length === 0) {
          throw new Error('El curso no tiene horarios configurados');
        }

        // 2. Obtener asignaturas del grupo
        console.log('Obteniendo asignaturas del grupo...');
        const urlAsignaturas = `../funciones/obtener_asignaturas.php?id_grupo=${idGrupo}&t=${Date.now()}`;
        
        const respAsig = await fetch(urlAsignaturas);
        
        if (!respAsig.ok) {
          throw new Error(`HTTP ${respAsig.status}: ${respAsig.statusText}`);
        }
        
        const textAsig = await respAsig.text();
        console.log('Respuesta asignaturas (raw):', textAsig);
        
        try {
          asignaturasGrupo = JSON.parse(textAsig);
        } catch (e) {
          console.error('Error parseando JSON:', e);
          asignaturasGrupo = [];
        }
        
        console.log('✓ Asignaturas obtenidas:', asignaturasGrupo);

        // 3. Actualizar información
        const opcionSeleccionada = grupoSelect.options[grupoSelect.selectedIndex];
        infoGrupo.textContent = opcionSeleccionada.text;
        cantidadHorarios.textContent = horariosPermitidos.length;
        cantidadAsignaturas.textContent = asignaturasGrupo.length;

        // 4. Construir tabla
        console.log('Construyendo tabla...');
        console.log('horariosPermitidos antes de construir:', horariosPermitidos);
        console.log('asignaturasGrupo antes de construir:', asignaturasGrupo);
        construirTabla();
        console.log('Filas en la tabla después de construir:', tablaBody.children.length);
        console.log('HTML de la tabla:', tablaBody.innerHTML.substring(0, 200));

        // 5. Cargar datos guardados
        console.log('Cargando datos guardados...');
        await cargarHorariosGuardados(idGrupo);

        // Mostrar tabla
        estadoCarga.style.display = "none";
        tablaContainer.style.display = "block";
        
        // FORZAR visibilidad de la tabla y tbody
        const tabla = document.getElementById('tablaHorarios');
        const tbody = document.getElementById('cuerpoTablaHorarios');
        if (tabla) {
          tabla.style.display = 'table';
          tabla.style.visibility = 'visible';
        }
        if (tbody) {
          tbody.style.display = 'table-row-group';
          tbody.style.visibility = 'visible';
        }
        
        // Verificar visibilidad final
        setTimeout(() => {
          console.log('=== VERIFICACIÓN FINAL ===');
          console.log('tablaContainer display:', window.getComputedStyle(tablaContainer).display);
          console.log('tabla display:', tabla ? window.getComputedStyle(tabla).display : 'N/A');
          console.log('tbody display:', tbody ? window.getComputedStyle(tbody).display : 'N/A');
          console.log('Filas en tbody:', tbody ? tbody.children.length : 0);
          console.log('Primera fila visible:', tbody && tbody.children[0] ? 
            window.getComputedStyle(tbody.children[0]).display : 'N/A');
        }, 100);
        
        console.log('✓ Carga completada exitosamente');

      } catch (error) {
        console.error('ERROR en cargarDatosGrupo:', error);
        estadoCarga.style.display = "none";
        
        Swal.fire({
          icon: 'error',
          title: 'Error al cargar datos',
          html: `
            <p>${error.message}</p>
            <small class="text-muted">Revisa la consola (F12) para más detalles</small>
          `,
          confirmButtonColor: '#dc3545'
        });
      }
    }

    function construirTabla() {
      console.log(`Construyendo tabla con ${horariosPermitidos.length} horarios`);
      console.log('Horarios:', horariosPermitidos);
      console.log('Asignaturas:', asignaturasGrupo);
      
      // Limpiar tabla
      tablaBody.innerHTML = '';

      // Verificar que horariosPermitidos es un array válido
      if (!Array.isArray(horariosPermitidos) || horariosPermitidos.length === 0) {
        console.error('horariosPermitidos no es válido:', horariosPermitidos);
        return;
      }

      // Construir filas
      horariosPermitidos.forEach((horario, index) => {
        console.log(`Creando fila ${index + 1}:`, horario);
        
        // Crear fila
        const tr = document.createElement('tr');
        
        // Columna de hora
        const tdHora = document.createElement('td');
        tdHora.className = 'fw-bold bg-light text-center';
        tdHora.innerHTML = `
          <strong>${horario.nombre_horario || 'Horario ' + (index + 1)}</strong><br>
          <small class="text-muted">${horario.hora_inicio} - ${horario.hora_fin}</small>
        `;
        tr.appendChild(tdHora);

        // 5 columnas para días (1=Lunes, 2=Martes, etc.)
        for (let dia = 1; dia <= 5; dia++) {
          const td = document.createElement('td');
          td.className = 'p-2';
          
          // Crear select
          const select = document.createElement('select');
          select.className = 'form-select form-select-sm';
          select.setAttribute('data-dia', dia);
          select.setAttribute('data-horario', horario.id_horario);

          // Opción vacía
          const optVacio = document.createElement('option');
          optVacio.value = '';
          optVacio.textContent = '-- Vacío --';
          select.appendChild(optVacio);

          // Opciones de asignaturas
          if (Array.isArray(asignaturasGrupo)) {
            asignaturasGrupo.forEach(asig => {
              const opt = document.createElement('option');
              opt.value = asig.id_asignatura;
              opt.textContent = asig.nombre_asignatura;
              select.appendChild(opt);
            });
          }

          td.appendChild(select);
          tr.appendChild(td);
        }

        // Agregar fila a la tabla
        tablaBody.appendChild(tr);
        console.log(`✓ Fila ${index + 1} agregada`);
      });

      console.log(`✓ Tabla construida: ${tablaBody.children.length} filas en el DOM`);
      
      // Verificar que las filas se agregaron
      if (tablaBody.children.length === 0) {
        console.error('ERROR: No se agregaron filas a la tabla');
        console.error('TablaBody:', tablaBody);
      } else {
        console.log('✓ Filas visibles en el DOM');
      }
    }

    async function cargarHorariosGuardados(idGrupo) {
      try {
        const url = `../funciones/obtener_horario.php?id_grupo=${idGrupo}&t=${Date.now()}`;
        const resp = await fetch(url);
        
        if (!resp.ok) {
          console.warn('No se pudieron cargar horarios guardados');
          return;
        }
        
        const text = await resp.text();
        let horariosGuardados = [];
        
        try {
          horariosGuardados = JSON.parse(text);
        } catch (e) {
          console.warn('Error parseando horarios guardados:', e);
          return;
        }

        console.log('Horarios guardados:', horariosGuardados);

        // Llenar selects con datos guardados
        horariosGuardados.forEach(item => {
          const select = tablaBody.querySelector(
            `select[data-dia='${item.dia_semana}'][data-horario='${item.id_horario}']`
          );
          
          if (select && item.id_asignatura) {
            select.value = item.id_asignatura;
          }
        });

        console.log('✓ Horarios guardados cargados');
      } catch (error) {
        console.error('Error cargando horarios guardados:', error);
      }
    }

    function limpiarTodo() {
      Swal.fire({
        title: '¿Estás seguro?',
        text: 'Se limpiarán todos los horarios asignados',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, limpiar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          tablaBody.querySelectorAll('select').forEach(select => {
            select.value = '';
          });

          Swal.fire({
            icon: 'success',
            title: 'Limpiado',
            text: 'Los horarios se han limpiado correctamente',
            timer: 2000,
            showConfirmButton: false
          });

          console.log('Horarios limpiados');
        }
      });
    }

    async function guardarCambios() {
      const idGrupo = grupoSelect.value;
      
      if (!idGrupo) {
        Swal.fire({
          icon: 'warning',
          title: 'Atención',
          text: 'Seleccioná un grupo primero',
          confirmButtonColor: '#ffc107'
        });
        return;
      }

      // Recopilar todos los datos
      const datos = [];
      tablaBody.querySelectorAll('select').forEach(select => {
        datos.push({
          id_horario: parseInt(select.getAttribute('data-horario')),
          dia_semana: parseInt(select.getAttribute('data-dia')),
          id_asignatura: select.value || null
        });
      });

      console.log('Guardando datos:', datos);

      try {
        const response = await fetch('../funciones/guardar_horario.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            id_grupo: idGrupo,
            horarios: datos
          })
        });

        const text = await response.text();
        console.log('Respuesta servidor:', text);
        
        let resultado;
        try {
          resultado = JSON.parse(text);
        } catch (e) {
          throw new Error('Respuesta inválida del servidor');
        }

        Swal.fire({
          icon: resultado.icono || 'success',
          title: resultado.titulo || 'Éxito',
          text: resultado.mensaje || 'Cambios guardados correctamente',
          confirmButtonColor: resultado.icono === 'success' ? '#198754' : '#dc3545'
        });

      } catch (error) {
        console.error('Error al guardar:', error);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'No se pudieron guardar los cambios',
          confirmButtonColor: '#dc3545'
        });
      }
    }

    console.log('✓ Gestión de horarios inicializada correctamente');
  }
})();
</script>