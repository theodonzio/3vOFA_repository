<div class="modal fade" id="agregarEspacioModal" tabindex="-1" aria-labelledby="agregarEspacioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="formEspacio" action="../funciones/agregar_espacio.php" method="POST">
        <div class="modal-header">
          <h5 data-traducible="Agregar Espacio" class="modal-title" id="agregarEspacioLabel">Agregar Espacio</h5>
        </div>

        <div class="modal-body">
          <!-- Tipo de Salón -->
          <div class="mb-3">
            <label data-traducible="Tipo de Salón" class="form-label">Tipo de Salón</label>
            <select name="tipo_salon" class="form-select" required>
              <option value="" data-traducible="Seleccione un tipo">Seleccione un tipo</option>
              <option value="Aula" data-traducible="Aula">Aula</option>
              <option value="Laboratorio" data-traducible="Laboratorio">Laboratorio</option>
              <option value="Salón" data-traducible="Salón">Salón</option>
              <option value="SUM" data-traducible="SUM">SUM</option>
            </select>
          </div>

          <!-- Nº de Espacio -->
          <div class="mb-3">
            <label data-traducible="Nº de Espacio" class="form-label">Nº de Espacio</label>
            <input 
              type="number" 
              name="descripcion" 
              id="descripcion" 
              class="form-control" 
              placeholder="Ej: 2" 
              data-traducible="Ej: 2"
              required>
          </div>

          <!-- Recursos dinámicos -->
          <label data-traducible="Selecciona los recursos que contiene:" class="form-label">Selecciona los recursos que contiene:</label><br>
          <div class="recursos">
            <?php
            // Conexión a la BD
            include '../login/conexion_bd.php';
            $sql = "SELECT id_recurso, nombre_recurso, tipo FROM recurso ORDER BY nombre_recurso ASC";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0):
              while ($row = $result->fetch_assoc()):
                $id = htmlspecialchars($row['id_recurso']);
                $nombre = htmlspecialchars($row['nombre_recurso']);
                $tipo = htmlspecialchars($row['tipo']);
            ?>
              <input type="checkbox" id="recurso<?= $id ?>" name="recursos[]" value="<?= $id ?>">
              <label for="recurso<?= $id ?>">
                <span><?= $nombre ?> <?= $tipo ? "($tipo)" : "" ?></span>
              </label><br>
            <?php
              endwhile;
            else:
            ?>
              <p data-traducible="No hay recursos disponibles">No hay recursos disponibles</p>
            <?php endif; ?>
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

<script src="../../js/modal_agregar_espacio.js"></script>
