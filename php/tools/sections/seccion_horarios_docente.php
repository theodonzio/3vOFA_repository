<?php
/**
 * Sección de Horarios para Docentes
 * Muestra SOLO las clases del docente (no otras asignaturas)
 */

// Obtiene ID del docente de la sesión
$id_docente_actual = $_SESSION['id_usuario'];
?>

<link rel="stylesheet" href="../css/style.css">

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
    <div class="card shadow-sm">
      <div class="card-body">
        <label for="grupoSelectDocente" class="form-label fw-bold">
          <i class="bi bi-people-fill me-2"></i>
          <span data-traducible="Seleccionar grupo:">Seleccionar grupo:</span>
        </label>
        <select id="grupoSelectDocente" class="form-select form-select-lg">
          <option value="" data-traducible="-- Seleccionar grupo --">-- Seleccionar grupo --</option>
          <?php
          if (isset($conn)) {
              // Obtiene grupos donde el docente está asignado
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
                  echo "<option value='' disabled data-traducible='No estás asignado a ningún grupo'>No estás asignado a ningún grupo</option>";
              }
              
              $stmt->close();
          }
          ?>
        </select>
        
        <!-- Muestra asignaturas del docente en este grupo -->
        <div id="asignaturasDocente" class="mt-3" style="display: none;">
          <div class="alert alert-success mb-0">
            <strong><i class="bi bi-book me-2"></i><span data-traducible="Tus asignaturas en este grupo:">Tus asignaturas en este grupo:</span></strong>
            <p id="listadoAsignaturas" class="mb-0 mt-2"></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabla de Horarios -->
  <div id="contenedorTablaHorariosDocente" style="display: none;">
    <div class="alert alert-info mb-3">
      <i class="bi bi-info-circle me-2"></i>
      <strong data-traducible="Grupo:">Grupo:</strong> <span id="infoGrupoDocente"></span> | 
      <strong data-traducible="Curso:">Curso:</strong> <span id="infoCursoDocente"></span>
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

    <div class="mt-3 text-center">
      <small class="text-muted">
        <i class="bi bi-info-circle me-1"></i>
        <span data-traducible="Solo se muestran tus clases asignadas">Solo se muestran tus clases asignadas</span>
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

<script src="../../js/seccion_horarios_docentes.js"></script>