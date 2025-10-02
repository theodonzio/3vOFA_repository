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

<!-- Modal Login y Registro (para Adscripta y Docente) -->
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="modalLoginLabel">Acceso de Usuarios</h5>
      </div>

      <div class="modal-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs mb-3" id="loginRegisterTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#loginPane" type="button" role="tab">Iniciar Sesión</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#registerPane" type="button" role="tab">Registrarse</button>
          </li>
        </ul>

        <!-- Tab content -->
        <div class="tab-content">
          <!-- Login -->
          <div class="tab-pane fade show active" id="loginPane" role="tabpanel">
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

          <!-- Registro -->
          <div class="tab-pane fade" id="registerPane" role="tabpanel">
            <form id="formRegistro" method="POST" action="../php/login/registrar_usuario.php">
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="tuemail@gmail.com" required>
              </div>
              <div class="mb-3">
                <label for="ci" class="form-label">Cédula de Identidad</label>
                <input type="text" class="form-control" id="ci" name="ci" placeholder="12345678" required>
              </div>
              <div class="mb-3">
                <label for="contrasenaRegistro" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasenaRegistro" name="contrasena" placeholder="Contraseña" required>
              </div>
              <div class="mb-3">
                <label for="rolRegistro" class="form-label">Rol</label>
                <select class="form-select" id="rolRegistro" name="rol" required>
                  <option value="">Seleccione un rol</option>
                  <option value="docente">Docente</option>
                  <option value="adscripta">Adscripta</option>
                </select>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <!-- Botones dinámicos según tab -->
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" form="formLogin" class="btn btn-primary" id="btnLogin">Ingresar</button>
        <button type="submit" form="formRegistro" class="btn btn-success d-none" id="btnRegistro">Registrar</button>
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

<script src="../js/tabsRegistro.js"></script>