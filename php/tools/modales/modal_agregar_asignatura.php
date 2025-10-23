<div class="modal fade" id="agregarAsignaturaModal" tabindex="-1" aria-labelledby="agregarAsignaturaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="../funciones/agregar_asignatura.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="agregarAsignaturaLabel" data-traducible="Agregar Asignatura">Agregar Asignatura</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label" data-traducible="Nombre de la Asignatura">Nombre de la Asignatura</label>
            <input type="text" name="nombre_asignatura" class="form-control" 
                   placeholder="Ej: Matemática" data-traducible="Ej: Matemática" required>
          </div>

          <div class="mb-3">
            <label class="form-label" data-traducible="Docente">Docente</label>
            <select name="id_docente" class="form-select" required>
              <option value="" data-traducible="Seleccionar docente...">Seleccionar docente...</option>
              <?php
              if (!isset($conn)) {
                include '../login/conexion_bd.php';
              }
              $docentes = $conn->query("SELECT id_usuario, nombre, apellido FROM usuario WHERE id_rol = 2");
              while ($d = $docentes->fetch_assoc()) {
                $nombreCompleto = htmlspecialchars($d['nombre'] . ' ' . $d['apellido']);
                echo "<option value='{$d['id_usuario']}' data-traducible='{$nombreCompleto}'>{$nombreCompleto}</option>";
              }
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label" data-traducible="Grupo">Grupo</label>
            <select name="id_grupo" class="form-select" required>
              <option value="" data-traducible="Seleccionar grupo...">Seleccionar grupo...</option>
              <?php
              $grupos = $conn->query("SELECT id_grupo, nombre_grupo FROM grupo");
              while ($g = $grupos->fetch_assoc()) {
                $nombreGrupo = htmlspecialchars($g['nombre_grupo']);
                echo "<option value='{$g['id_grupo']}' data-traducible='{$nombreGrupo}'>{$nombreGrupo}</option>";
              }
              ?>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-traducible="Cancelar">Cancelar</button>
          <button type="submit" class="btn btn-success" data-traducible="Guardar">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>