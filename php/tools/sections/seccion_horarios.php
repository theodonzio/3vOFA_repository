<?php
/**
 * Sección de Gestión de Horarios por Grupo - COMPLETA
 */

// Obtener todas las asignaturas disponibles con sus grupos asignados
$asignaturas = [];
if (isset($conn)) {
  $resAsig = $conn->query("
    SELECT DISTINCT a.id_asignatura, a.nombre_asignatura, ga.id_grupo
    FROM asignatura a
    LEFT JOIN grupo_asignatura ga ON a.id_asignatura = ga.id_asignatura
    ORDER BY a.nombre_asignatura
  ");
  if ($resAsig) {
    while ($a = $resAsig->fetch_assoc()) {
      $asignaturas[] = $a;
    }
  }
}
?>

<div class="container my-5">
  <h2 class="text-center mb-4" id="GestionHorarios">
    <span data-traducible="Gestión de Horarios por Grupo">Gestión de Horarios por Grupo</span>
  </h2>
  
  <p class="text-center text-muted mb-4">
    Seleccioná un grupo para asignarle horarios y materias
  </p>

  <!-- Selector de Grupo -->
  <div class="d-flex justify-content-center mb-4">
    <div class="card shadow-sm" style="max-width: 400px; width: 100%;">
      <div class="card-body">
        <label for="grupoSelect" class="form-label fw-bold">
          <i class="bi bi-people-fill me-2"></i>
          <span data-traducible="Seleccionar grupo:">Seleccionar grupo:</span>
        </label>
        <select id="grupoSelect" class="form-select form-select-lg">
          <option value="" data-traducible="-- Seleccionar grupo --">-- Seleccionar grupo --</option>
          <?php
          if (isset($conn)) {
            $resGr = $conn->query("SELECT id_grupo, nombre_grupo FROM grupo ORDER BY nombre_grupo");
            while ($g = $resGr->fetch_assoc()) {
              echo "<option value='{$g['id_grupo']}'>{$g['nombre_grupo']}</option>";
            }
          }
          ?>
        </select>
      </div>
    </div>
  </div>

  <!-- Tabla de Horarios -->
  <div id="tablaHorariosContainer" style="display: none;">
    <div class="table-responsive">
      <table class="table table-bordered text-center align-middle table-hover" id="tablaHorarios">
        <thead class="table-primary">
          <tr>
            <th data-traducible="Hora">Hora</th>
            <th data-traducible="Lunes">Lunes</th>
            <th data-traducible="Martes">Martes</th>
            <th data-traducible="Miércoles">Miércoles</th>
            <th data-traducible="Jueves">Jueves</th>
            <th data-traducible="Viernes">Viernes</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Obtener todos los horarios
          $horarios = [];
          if (isset($conn)) {
            $resHor = $conn->query("SELECT * FROM horario ORDER BY hora_inicio");
            if ($resHor) {
              while ($h = $resHor->fetch_assoc()) {
                $horarios[] = $h;
              }
            }
          }

          // Generar filas
          foreach ($horarios as $fila) {
            echo "<tr style='display: none;' data-horario='{$fila['id_horario']}'>";
            echo "<td class='table-secondary'><strong data-traducible='{$fila['nombre_horario']}'>{$fila['nombre_horario']}</strong><br><small>{$fila['hora_inicio']} - {$fila['hora_fin']}</small></td>";
            
            // 5 columnas para los días de la semana (1=Lunes, 2=Martes, etc.)
            for ($dia = 1; $dia <= 5; $dia++) {
              echo "<td>";
              echo "<select class='form-select form-select-sm selectHorario' data-dia='{$dia}' data-hora='{$fila['id_horario']}'>";
              echo "<option value='' data-traducible='-- Vacío --'>-- Vacío --</option>";
              
              // Las asignaturas se cargarán dinámicamente según el grupo
              echo "</select>";
              echo "</td>";
            }
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
      <button id="guardarCambios" class="btn btn-success btn-lg px-5">
        <i class="bi bi-save me-2"></i>
        <span data-traducible="Guardar Cambios">Guardar Cambios</span>
      </button>
    </div>
  </div>
  
  <div id="mensajeSeleccionar" class="text-center text-muted mt-4">
    <i class="bi bi-arrow-up-circle fs-1"></i>
    <p class="mt-2">Seleccioná un grupo para comenzar</p>
  </div>
</div>

<script>
// Script MEJORADO para horarios
const grupoSelect = document.getElementById("grupoSelect");
const guardarBtn = document.getElementById("guardarCambios");
const tablaContainer = document.getElementById("tablaHorariosContainer");
const mensajeSeleccionar = document.getElementById("mensajeSeleccionar");

// Almacenar asignaturas del grupo actual
let asignaturasGrupo = [];

grupoSelect.addEventListener("change", async () => {
  const idGrupo = grupoSelect.value;

  if (!idGrupo) {
    tablaContainer.style.display = "none";
    mensajeSeleccionar.style.display = "block";
    return;
  }

  mensajeSeleccionar.style.display = "none";
  tablaContainer.style.display = "block";

  try {
    // 1. Obtener horarios permitidos del curso
    console.log('Obteniendo horarios del curso...');
    const respHorarios = await fetch(`../funciones/obtener_horarios_curso.php?id_grupo=${idGrupo}`);
    
    if (!respHorarios.ok) {
      throw new Error(`Error HTTP: ${respHorarios.status}`);
    }
    
    const horariosCurso = await respHorarios.json();
    console.log('Horarios del curso:', horariosCurso);

    // 2. Obtener asignaturas del grupo
    console.log('Obteniendo asignaturas del grupo...');
    const respAsig = await fetch(`../funciones/obtener_asignaturas.php?id_grupo=${idGrupo}`);
    
    if (!respAsig.ok) {
      throw new Error(`Error HTTP: ${respAsig.status}`);
    }
    
    asignaturasGrupo = await respAsig.json();
    console.log('Asignaturas del grupo:', asignaturasGrupo);

    // Verificar si hay asignaturas
    if (asignaturasGrupo.length === 0) {
      if (typeof Swal !== 'undefined') {
        Swal.fire({
          icon: 'warning',
          title: 'Sin asignaturas',
          text: 'Este grupo no tiene asignaturas asignadas. Por favor, agregá asignaturas primero.',
          confirmButtonColor: '#ffc107'
        });
      } else {
        alert('Este grupo no tiene asignaturas asignadas. Por favor, agregá asignaturas primero.');
      }
    }

    // 3. Ocultar todas las filas y limpiar selects
    document.querySelectorAll("#tablaHorarios tbody tr").forEach(fila => {
      fila.style.display = "none";
    });
    
    document.querySelectorAll(".selectHorario").forEach(sel => {
      sel.innerHTML = '<option value="" data-traducible="-- Vacío --">-- Vacío --</option>';
    });

    // 4. Mostrar solo las filas de horarios del curso y llenar selects
    if (horariosCurso.length === 0) {
      if (typeof Swal !== 'undefined') {
        Swal.fire({
          icon: 'info',
          title: 'Sin horarios configurados',
          text: 'El curso de este grupo no tiene horarios configurados.',
          confirmButtonColor: '#0d6efd'
        });
      } else {
        alert('El curso de este grupo no tiene horarios configurados.');
      }
      return;
    }

    horariosCurso.forEach(h => {
      const fila = document.querySelector(`tr[data-horario='${h.id_horario}']`);
      if (fila) {
        fila.style.display = "";
        
        // Llenar todos los selects de esta fila con las asignaturas del grupo
        fila.querySelectorAll('.selectHorario').forEach(sel => {
          asignaturasGrupo.forEach(asig => {
            const option = document.createElement('option');
            option.value = asig.id_asignatura;
            option.textContent = asig.nombre_asignatura;
            option.setAttribute('data-traducible', asig.nombre_asignatura);
            sel.appendChild(option);
          });
        });
      }
    });

    // 5. Cargar horarios ya guardados
    console.log('Cargando horarios guardados...');
    const respGuardados = await fetch(`../funciones/obtener_horario.php?id_grupo=${idGrupo}`);
    
    if (!respGuardados.ok) {
      throw new Error(`Error HTTP: ${respGuardados.status}`);
    }
    
    const horariosGuardados = await respGuardados.json();
    console.log('Horarios guardados:', horariosGuardados);
    
    // Asegurarse de que horariosGuardados es un array
    if (Array.isArray(horariosGuardados)) {
      horariosGuardados.forEach(item => {
        const sel = document.querySelector(`.selectHorario[data-dia='${item.dia_semana}'][data-hora='${item.id_horario}']`);
        if (sel && item.id_asignatura) {
          sel.value = item.id_asignatura;
        }
      });
    } else {
      console.warn('horariosGuardados no es un array:', horariosGuardados);
    }

  } catch (err) {
    console.error("Error completo:", err);
    
    if (typeof Swal !== 'undefined') {
      Swal.fire({
        icon: 'error',
        title: 'Error al cargar',
        html: `
          <p>Hubo un error al cargar los horarios.</p>
          <small class="text-muted">Detalles: ${err.message}</small>
          <br><br>
          <small>Por favor, abrí la consola del navegador (F12) para más información.</small>
        `,
        confirmButtonColor: '#dc3545'
      });
    } else {
      alert(`Hubo un error al cargar los horarios: ${err.message}`);
    }
  }
});

// Guardar cambios
guardarBtn.addEventListener("click", async () => {
  if (!grupoSelect.value) {
    alert("Seleccioná un grupo primero");
    return;
  }

  const datos = [];
  document.querySelectorAll(".selectHorario").forEach(sel => {
    if (sel.closest("tr").style.display !== "none") {
      datos.push({
        id_horario: parseInt(sel.dataset.hora),
        dia_semana: parseInt(sel.dataset.dia),
        id_asignatura: sel.value || null
      });
    }
  });

  try {
    const response = await fetch("../funciones/guardar_horario.php", {
      method: "POST",
      headers: {"Content-Type": "application/json"},
      body: JSON.stringify({
        id_grupo: grupoSelect.value,
        horarios: datos
      })
    });

    const resp = await response.json();
    
    // Usar SweetAlert si está disponible, sino alert normal
    if (typeof Swal !== 'undefined') {
      Swal.fire({
        icon: resp.icono,
        title: resp.titulo,
        text: resp.mensaje,
        confirmButtonColor: resp.icono === 'success' ? '#198754' : '#dc3545'
      });
    } else {
      alert(resp.mensaje);
    }
    
  } catch (error) {
    console.error("Error:", error);
    if (typeof Swal !== 'undefined') {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'No se pudieron guardar los cambios',
        confirmButtonColor: '#dc3545'
      });
    } else {
      alert("Error al guardar los cambios");
    }
  }
});
</script>