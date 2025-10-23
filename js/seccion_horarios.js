/**
 * Gestión de Horarios por Grupo
 * Sistema completo para asignar horarios y materias a grupos
 */

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

    // Event listeners
    grupoSelect.addEventListener("change", cargarDatosGrupo);
    guardarBtn.addEventListener("click", guardarCambios);
    limpiarBtn.addEventListener("click", limpiarTodo);

    /**
     * Cargar datos del grupo seleccionado
     */
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

        // 3. Obtener nombre del grupo
        const selectedOption = grupoSelect.options[grupoSelect.selectedIndex];
        const nombreGrupo = selectedOption.text;
        
        // Actualizar información
        infoGrupo.textContent = nombreGrupo;
        cantidadHorarios.textContent = horariosPermitidos.length;
        cantidadAsignaturas.textContent = asignaturasGrupo.length;

        // 4. Construir tabla
        console.log('Construyendo tabla...');
        construirTabla();

        // 5. Cargar horarios guardados
        console.log('Cargando horarios guardados...');
        await cargarHorariosGuardados(idGrupo);

        // Mostrar tabla
        estadoCarga.style.display = "none";
        tablaContainer.style.display = "block";
        
        grupoActual = idGrupo;
        console.log('✓ Carga completada exitosamente');

      } catch (error) {
        console.error('ERROR en cargarDatosGrupo:', error);
        estadoCarga.style.display = "none";
        
        // Mostrar error con SweetAlert2
        if (typeof Swal !== 'undefined') {
          Swal.fire({
            icon: 'error',
            title: 'Error al cargar datos',
            html: `
              <p>${error.message}</p>
              <small class="text-muted">Revisa la consola (F12) para más detalles</small>
            `,
            confirmButtonColor: '#dc3545'
          });
        } else {
          alert('Error al cargar datos: ' + error.message);
        }
        
        // Volver a mostrar mensaje inicial
        mensajeInicial.style.display = "block";
      }
    }

    /**
     * Construir tabla de horarios con selects
     */
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

    /**
     * Cargar horarios guardados previamente
     * @param {number} idGrupo - ID del grupo
     */
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

    /**
     * Limpiar todos los horarios
     */
    function limpiarTodo() {
      if (typeof Swal !== 'undefined') {
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
      } else {
        // Fallback si SweetAlert2 no está disponible
        if (confirm('¿Estás seguro? Se limpiarán todos los horarios asignados')) {
          tablaBody.querySelectorAll('select').forEach(select => {
            select.value = '';
          });
          alert('Los horarios se han limpiado correctamente');
          console.log('Horarios limpiados');
        }
      }
    }

    /**
     * Guardar cambios en el servidor
     */
    async function guardarCambios() {
      const idGrupo = grupoSelect.value;
      
      if (!idGrupo) {
        if (typeof Swal !== 'undefined') {
          Swal.fire({
            icon: 'warning',
            title: 'Atención',
            text: 'Seleccioná un grupo primero',
            confirmButtonColor: '#ffc107'
          });
        } else {
          alert('Seleccioná un grupo primero');
        }
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

      // Añadir estado de carga al botón
      guardarBtn.classList.add('loading');
      guardarBtn.disabled = true;

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

        if (typeof Swal !== 'undefined') {
          Swal.fire({
            icon: resultado.icono || 'success',
            title: resultado.titulo || 'Éxito',
            text: resultado.mensaje || 'Cambios guardados correctamente',
            confirmButtonColor: resultado.icono === 'success' ? '#198754' : '#dc3545'
          });
        } else {
          alert(resultado.mensaje || 'Cambios guardados correctamente');
        }

      } catch (error) {
        console.error('Error al guardar:', error);
        
        if (typeof Swal !== 'undefined') {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudieron guardar los cambios',
            confirmButtonColor: '#dc3545'
          });
        } else {
          alert('Error: No se pudieron guardar los cambios');
        }
      } finally {
        // Remover estado de carga del botón
        guardarBtn.classList.remove('loading');
        guardarBtn.disabled = false;
      }
    }

    console.log('✓ Gestión de horarios inicializada correctamente');
  }
})();