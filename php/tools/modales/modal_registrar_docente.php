<div class="modal fade" id="registrarDocenteModal" tabindex="-1" aria-labelledby="registrarDocenteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="../funciones/registrar_docente.php" method="POST">
        <div class="modal-header">
          <h5 data-traducible="Registrar Docente" class="modal-title" id="registrarDocenteLabel">Registrar Docente</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label" data-traducible="Nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" data-traducible="Nombre" required>
          </div>
          <div class="mb-3">
            <label class="form-label" data-traducible="Apellido">Apellido</label>
            <input type="text" name="apellido" class="form-control" placeholder="Apellido" data-traducible="Apellido" required>
          </div>
          <div class="mb-3">
            <label class="form-label" data-traducible="Cédula">Cédula</label>
            <input type="text" name="cedula" class="form-control" placeholder="Cédula" data-traducible="Cédula" maxlength="8" pattern="[0-9]{8}" required>
            <small class="form-text text-muted">8 dígitos sin puntos ni guiones</small>
          </div>
          <div class="mb-3">
            <label class="form-label" data-traducible="Email">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email" data-traducible="Email" required>
          </div>
          <div class="mb-3">
            <label class="form-label" data-traducible="Contraseña">Contraseña</label>
            <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" data-traducible="Contraseña" 
                   pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$" required>
            <small class="form-text text-muted">Mínimo 6 caracteres, al menos una letra y un número</small>
          </div>
          <input type="hidden" name="id_rol" value="2">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-traducible="Cancelar">Cancelar</button>
          <button type="submit" class="btn btn-success" data-traducible="Guardar">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>