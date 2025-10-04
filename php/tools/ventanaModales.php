<link rel="stylesheet" href="../../css/style.css">

<div class="botones">
  <!-- Botón Adscripta -->
  <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalLogin" data-role="adscripta">
    <img src="../img/icons/faceid_icon.png" class="indexlogo"> Adscripto
  </button>

  <!-- Botón Estudiante -->
  <button id="btnEstudiante" type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#modalEstudiante">
    <img src="../img/icons/student_icon.png" class="indexlogo"> Estudiante
  </button>

  <!-- Botón Docente -->
  <button type="button" class="btn btn-secondary btn-lg text-white" data-bs-toggle="modal" data-bs-target="#modalLogin" data-role="docente">
    <img src="../img/icons/book_icon.png" class="indexlogo"> Docente
  </button>
</div>

<!-- Modal Login (solo inicio de sesión) -->
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="modalLoginLabel">Acceso de Usuarios</h5>
      </div>

      <div class="modal-body">
        <!-- Formulario Login -->
        <form id="formLogin" method="POST" action="../php/login/validar_login.php">
          <div class="mb-3">
            <label for="usuario" class="form-label">C.I | Email</label>
            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="tuemail@gmail.com" required>
          </div>
          <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña" required>
          </div>
          <input type="hidden" id="rol" name="rol">
        </form>
      </div>
      <div class="modal-footer">
        <!-- Botones -->
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" form="formLogin" class="btn btn-primary" id="btnLogin">Ingresar</button>
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
      </div>

      <div class="modal-body">
        <form id="formEstudiante" action="../php/usuarios/estudiante.php" method="GET">
          <div class="mb-3">
            <label for="opcionEstudiante" class="form-label">Elige una opción</label>
            <select class="form-select" id="opcionEstudiante" name="opcion">
              <option value="1MC">1ºMC (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)</option>
              <option value="1MD">1ºMD (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)</option>
              <option value="2MA">2ºMA (TECNOLOGÍAS DE LA INFORMACIÓN)</option>
              <option value="2MB">2ºMB (TECNOLOGÍAS DE LA INFORMACIÓN)</option>
              <option value="2MD">2ºMD (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)</option>
              <option value="3MA">3ºMA (TECNOLOGÍAS DE LA INFORMACIÓN)</option>
              <option value="3MB">3ºMB (TECNOLOGÍAS DE LA INFORMACIÓN)</option>
              <option value="3MD">3ºMD (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)</option>
              <option value="3BA">3ºBA (ROBOTICA Y TELECOMUNICACIONES)</option>
            </select>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" form="formEstudiante" class="btn btn-danger">Continuar</button>
      </div>
    </div>
  </div>
</div>