<?php
  include '../tools/head.php';
  include '../tools/header_adscripta.php';
?>

<!-- Título Superior -->
<div class="text-center titulo-adscripta">
  <img src="../../img/ofalogos/blue-logo.png" class="tinylogo"> 
    <img src="../../img/blueicons/adscriptablue.png" class="blue_icon"> 
  <h1 class="display-4 fw-bold text-primary">Sistema de Gestión OFA</h1>
  <p class="lead text-muted">Panel exclusivo para Adscripta</p>
</div>

<!-- Hero Section con imagen de fondo -->
<div class="hero text-white py-5 d-flex align-items-center justify-content-center" style="background-image: url('https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover; background-position: center; position: relative; min-height: 400px;">
  
  <!-- Overlay para mejorar legibilidad del texto -->
  <div style="position: absolute; top:0; left:0; right:0; bottom:0; background: rgba(0,0,0,0.4);"></div>

  <div class="container text-center" style="position: relative; z-index: 1;">

    <h2 class="display-6 fw-semibold">Docentes del Sistema</h2>
    <p class="mb-4">Desde aquí puedes gestionar a los docentes registrados en el sistema</p>

    <!-- Botones juntos -->
    <div class="d-flex justify-content-center gap-3">
      <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#registrarDocenteModal">
        Registrar Docente
      </button>
      <a href="docentes.php" class="btn btn-outline-light btn-lg">
        Ver Docentes
      </a>
    </div>

  </div>
</div>


<!-- Modal Registrar Docente -->
<div class="modal fade" id="registrarDocenteModal" tabindex="-1" aria-labelledby="registrarDocenteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="../funciones/registrar_docente.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="registrarDocenteLabel">Registrar Docente</h5>
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
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>