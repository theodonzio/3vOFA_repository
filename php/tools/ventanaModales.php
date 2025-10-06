<link rel="stylesheet" href="../../css/style.css">

<div class="botones">
  <!-- Botón unificado: Docente / Adscripto -->
  <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalLogin" data-role="docente_adscripto">
    <img src="../img/icons/faceid_icon.png" class="indexlogo">
    <span data-traducible="Docente / Adscripto">Personal</span>
  </button>

  <!-- Botón Estudiante (sin cambios) -->
  <button id="btnEstudiante" type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#modalEstudiante">
    <img src="../img/icons/student_icon.png" class="indexlogo">
    <span data-traducible="Estudiante">Estudiante</span>
  </button>
</div>


<!-- Modal Login -->
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLoginLabel" data-traducible="Acceso de Usuarios">Acceso de Usuarios</h5>
      </div>

      <div class="modal-body">
        <form id="formLogin" method="POST" action="../php/login/validar_login.php">
          <div class="mb-3">
            <label for="usuario" class="form-label" data-traducible="C.I | Email">C.I | Email</label>
            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="tuemail@gmail.com" required>
          </div>
          <div class="mb-3">
            <label for="contrasena" class="form-label" data-traducible="Contraseña">Contraseña</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña" required>
          </div>
          <input type="hidden" id="rol" name="rol">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-traducible="Cancelar">Cancelar</button>
        <button type="submit" form="formLogin" class="btn btn-primary" id="btnLogin" data-traducible="Ingresar">Ingresar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Estudiante -->
<div class="modal fade" id="modalEstudiante" tabindex="-1" aria-labelledby="modalEstudianteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEstudianteLabel" data-traducible="Selecciona una opción">Selecciona una opción</h5>
      </div>

      <div class="modal-body">
        <form id="formEstudiante" action="../php/usuarios/estudiante.php" method="GET">
          <div class="mb-3">
            <label for="opcionEstudiante" class="form-label" data-traducible="Elige una opción">Elige una opción</label>
            <select class="form-select" id="opcionEstudiante" name="opcion">
              <option value="1MC" data-traducible="1ºMC (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)">1ºMC (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)</option>
              <option value="1MD" data-traducible="1ºMD (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)">1ºMD (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)</option>
              <option value="2MA" data-traducible="2ºMA (TECNOLOGÍAS DE LA INFORMACIÓN)">2ºMA (TECNOLOGÍAS DE LA INFORMACIÓN)</option>
              <option value="2MB" data-traducible="2ºMB (TECNOLOGÍAS DE LA INFORMACIÓN)">2ºMB (TECNOLOGÍAS DE LA INFORMACIÓN)</option>
              <option value="2MD" data-traducible="2ºMD (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)">2ºMD (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)</option>
              <option value="3MA" data-traducible="3ºMA (TECNOLOGÍAS DE LA INFORMACIÓN)">3ºMA (TECNOLOGÍAS DE LA INFORMACIÓN)</option>
              <option value="3MB" data-traducible="3ºMB (TECNOLOGÍAS DE LA INFORMACIÓN)">3ºMB (TECNOLOGÍAS DE LA INFORMACIÓN)</option>
              <option value="3MD" data-traducible="3ºMD (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)">3ºMD (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)</option>
              <option value="3BA" data-traducible="3ºBA (ROBOTICA Y TELECOMUNICACIONES)">3ºBA (ROBOTICA Y TELECOMUNICACIONES)</option>
            </select>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-traducible="Cancelar">Cancelar</button>
        <button type="submit" form="formEstudiante" class="btn btn-success" data-traducible="Continuar">Continuar</button>
      </div>
    </div>
  </div>
</div>