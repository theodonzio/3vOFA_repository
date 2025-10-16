<?php
/**
 * Sección de Gestión de Horarios por Grupo - SIMPLIFICADA
 */

// Obtener todas las asignaturas disponibles
$asignaturas = [];
if (isset($conn)) {
  $resAsig = $conn->query("SELECT id_asignatura, nombre_asignatura FROM asignatura ORDER BY nombre_asignatura");
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
          <option value="">-- Seleccionar grupo --</option>
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
            <th>Hora</th>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miércoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Obtener todos los horarios
          $horarios = [];
          if (isset($conn)) {
            $resHor = $conn->query("SELECT * FROM horario ORDER BY id_horario");
            if ($resHor) {
              while ($h = $resHor->fetch_assoc()) {
                $horarios[] = $h;
              }
            }
          }

          // Generar filas
          foreach ($horarios as $fila) {
            echo "<tr style='display: none;' data-horario='{$fila['id_horario']}'>";
            echo "<td class='table-secondary'><strong>{$fila['nombre_horario']}</strong><br><small>{$fila['hora_inicio']} - {$fila['hora_fin']}</small></td>";
            
            // 5 columnas para los días de la semana
            for ($dia = 1; $dia <= 5; $dia++) {
              echo "<td>";
              echo "<select class='form-select form-select-sm selectHorario' data-dia='{$dia}' data-hora='{$fila['id_horario']}'>";
              echo "<option value=''>-- Vacío --</option>";
              
              foreach ($asignaturas as $a) {
                echo "<option value='{$a['id_asignatura']}'>{$a['nombre_asignatura']}</option>";
              }
              
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
// Script SIMPLE para horarios
const grupoSelect = document.getElementById("grupoSelect");
const guardarBtn = document.getElementById("guardarCambios");
const tablaContainer = document.getElementById("tablaHorariosContainer");
const mensajeSeleccionar = document.getElementById("mensajeSeleccionar");

grupoSelect.addEventListener("change", () => {
  const idGrupo = grupoSelect.value;

  if (!idGrupo) {
    tablaContainer.style.display = "none";
    mensajeSeleccionar.style.display = "block";
    return;
  }

  mensajeSeleccionar.style.display = "none";
  tablaContainer.style.display = "block";

  // Ocultar todas las filas
  document.querySelectorAll("#tablaHorarios tbody tr").forEach(fila => {
    fila.style.display = "none";
  });
  
  // Limpiar todos los selects
  document.querySelectorAll(".selectHorario").forEach(sel => sel.value = "");

  // 1. Obtener horarios permitidos del curso
  fetch(`../funciones/obtener_horarios_curso.php?id_grupo=${idGrupo}`)
    .then(res => res.json())
    .then(horariosCurso => {
      // Mostrar solo las filas de horarios del curso
      horariosCurso.forEach(h => {
        const fila = document.querySelector(`tr[data-horario='${h.id_horario}']`);
        if (fila) fila.style.display = "";
      });

      // 2. Cargar horarios ya guardados
      return fetch(`../funciones/obtener_horario.php?id_grupo=${idGrupo}`);
    })
    .then(res => res.json())
    .then(data => {
      data.forEach(item => {
        const sel = document.querySelector(`.selectHorario[data-dia='${item.dia_semana}'][data-hora='${item.id_horario}']`);
        if (sel) sel.value = item.id_asignatura || "";
      });
    })
    .catch(err => console.error("Error:", err));
});

// Guardar cambios
guardarBtn.addEventListener("click", () => {
  if (!grupoSelect.value) {
    alert("Seleccioná un grupo primero");
    return;
  }

  const datos = [];
  document.querySelectorAll(".selectHorario").forEach(sel => {
    if (sel.closest("tr").style.display !== "none") {
      datos.push({
        id_horario: sel.dataset.hora,
        dia_semana: sel.dataset.dia,
        id_asignatura: sel.value || null
      });
    }
  });

  fetch("../funciones/guardar_horario.php", {
    method: "POST",
    headers: {"Content-Type": "application/json"},
    body: JSON.stringify({
      id_grupo: grupoSelect.value,
      horarios: datos
    })
  })
  .then(res => res.json())
  .then(resp => {
    alert(resp.mensaje);
    if (resp.icono === "success") {
      // Opcional: recargar la página o mantener los datos
    }
  })
  .catch(() => alert("Error al guardar"));
});
</script>