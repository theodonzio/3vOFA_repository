<link rel="stylesheet" href="../../css/style.css">

<div class="container my-5">
  <h2 class="text-center mb-4" id="GestionHorarios">
    <span data-traducible="Gestión de Horarios por Grupo">Gestión de Horarios por Grupo</span>
  </h2>
  
  <p class="text-center text-muted mb-4">
    <span data-traducible="Seleccioná un grupo para asignarle horarios y materias">Seleccioná un grupo para asignarle horarios y materias</span>
  </p>

  <!-- Selector de Grupo -->
  <div class="d-flex justify-content-center mb-4">
    <div class="card shadow-sm">
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
      <strong data-traducible="Grupo">Grupo:</strong> <span id="infoGrupo"></span> | 
      <strong data-traducible="Horarios disponibles">Horarios disponibles:</strong> <span id="cantidadHorarios"></span> | 
      <strong data-traducible="Asignaturas">Asignaturas:</strong> <span id="cantidadAsignaturas"></span>
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

<script src="../../js/seccion_horarios.js"></script>