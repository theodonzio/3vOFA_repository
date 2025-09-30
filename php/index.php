<?php
  include '../php/tools/head.php';
?>

<link rel="stylesheet" href="../css/style.css">

<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
    <div class="logo" style="display: flex; justify-content: center; align-items: center; width: 100%;">
      <img src="../img/ofalogos/fulltextnegativo.png" id="logo-barra">
    </div>
</header>

<body class="body_index">
<main class="selector">

    <div class="bienvenida">
    <h2 class="font-weight-bold">Bienvenid@</h2>
    <h5>¿Quién eres?</h5>
    </div>

<div class="botones">
  <!-- Botón Adscripta -->
  <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalLogin" data-role="adscripta">
    <img src="../img/icons/faceid_icon.png" class="indexlogo"> Adscripto
  </button>

  <!-- Botón Estudiante -->
  <button id="btnEstudiante" type="button" class="btn btn-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#modalEstudiante">
    <img src="../img/icons/student_icon.png" class="indexlogo"> Estudiante
  </button>

  <!-- Botón Docente -->
  <button type="button" class="btn btn-secondary btn-lg text-white" data-bs-toggle="modal" data-bs-target="#modalLogin" data-role="docente">
    <img src="../img/icons/book_icon.png" class="indexlogo"> Docente
  </button>
</div>

<!-- Modal Login (para Adscripta y Docente) -->
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="modalLoginLabel">Iniciar Sesión</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">
        <form id="formLogin" method="POST">
          <div class="mb-3">
            <label for="usuario" class="form-label">C.I | Email</label>
            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="tuemail@gmail.com" required >
          </div>
          <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña" required>
          </div>
          <!-- campo oculto para saber a dónde enviar -->
          <input type="hidden" id="rol" name="rol">
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" form="formLogin" class="btn btn-primary">Ingresar</button>
      </div>

    </div>
  </div>
</div>

<!-- Modal Estudiante -->
<div class="modal fade" id="modalEstudiante" tabindex="-1" aria-labelledby="modalEstudianteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="modalEstudianteLabel">Selecciona una opción</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">
        <form id="formEstudiante" action="../php/usuarios/estudiante.php" method="GET">
          <div class="mb-3">
            <label for="opcionEstudiante" class="form-label">Elige una opción</label>
            <select class="form-select" id="opcionEstudiante" name="opcion">
              <option value="" selected disabled>-</option>
              <option value="#">1ºMC (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)</option>
              <option value="#">1ºMD (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)</option>
              <option value="#">2ºMA (TECNOLOGÍAS DE LA INFORMACIÓN)</option>
              <option value="#">2ºMB (TECNOLOGÍAS DE LA INFORMACIÓN)</option>
              <option value="#">2ºMD (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)</option>
              <option value="#">3ºMA (TECNOLOGÍAS DE LA INFORMACIÓN)</option>
              <option value="#">3ºMB (TECNOLOGÍAS DE LA INFORMACIÓN)</option>
              <option value="#">3ºMD (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)</option>
              <option value="#">3ºBA (ROBOTICA Y TELECOMUNICACIONES)</option>
            </select>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" form="formEstudiante" class="btn btn-primary">Continuar</button>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>