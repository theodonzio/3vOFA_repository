<?php
  include '../tools/head.php';
  include '../tools/header_adscripta.php';
?>

<div class="container mt-5">
    <h2 class="text-center">Panel de Adscripta</h2>
    <div class="text-center mt-4">
        <!-- Botón para abrir el modal -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registrarDocenteModal">
            Registrar Docente
        </button>
    </div>
</div>

<!-- Modal Registrar Docente -->
<div class="modal fade" id="registrarDocenteModal" tabindex="-1" aria-labelledby="registrarDocenteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="../funciones/registrar_docente.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="registrarDocenteLabel">Registrar Docente</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Apellido</label>
                <input type="text" name="apellido" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Cédula</label>
                <input type="text" name="cedula" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control" required>
            </div>
            <input type="hidden" name="id_rol" value="2"> <!-- Rol docente -->
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Guardar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>