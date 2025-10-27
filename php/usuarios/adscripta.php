<?php
session_start();

// Verificar sesión
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../index.php?login=" . (!isset($_SESSION['id_usuario']) ? 'required' : 'unauthorized'));
    exit;
}

include '../tools/head.php';
include '../tools/headers/header_adscripta.php';
include '../login/conexion_bd.php';
// Limpiar reservas antiguas automáticamente
include '../funciones/limpiar_reservas_antiguas.php';
?>

<body>

<div class="text-center titulo-adscripta">
    <img src="../../img/ofalogos/blue-logo.png" class="tinylogo"> 
    <img src="../../img/blueicons/adscriptablue.png" class="blue_icon"> 
    <h1 data-traducible="Sistema de Gestión OFA" class="display-4 fw-bold text-primary">Sistema de Gestión</h1>
    <p data-traducible="Panel exclusivo para Adscripta" class="lead text-muted">Panel exclusivo para Adscripta</p>
    <?php include '../tools/reloj.php'; ?>
</div>

<div id="HeroDocentes" class="hero hero-imagen text-white py-5 d-flex align-items-center justify-content-center" 
     style="background-image: url('https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=2070&auto=format&fit=crop');">
    <div class="hero-overlay"></div>
    <div class="container text-center hero-content">
        <h2 data-traducible="Docentes del Sistema" class="display-6 fw-semibold">Docentes del Sistema</h2>
        <p data-traducible="Desde aquí puedes gestionar a los docentes registrados en el sistema" class="mb-4">
            Desde aquí puedes gestionar a los docentes registrados en el sistema
        </p>
        <div class="d-flex justify-content-center gap-3">
            <button class="btn btn-light btn-lg btn_wicon" data-bs-toggle="modal" data-bs-target="#registrarDocenteModal">
                <i class="bi bi-person-plus-fill"></i>
                <span data-traducible="Registrar Docente">Registrar Docente</span>
            </button>
            <a href="../PaginasAdcriptas/docentes.php" class="btn btn-outline-light btn-lg" data-traducible="Ver Docentes">Ver Docentes</a>
        </div>
    </div>
</div>

<div id="HeroHorarios" class="hero hero-imagen text-white py-5 d-flex align-items-center justify-content-center" 
     style="background-image: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?q=80&w=2070&auto=format&fit=crop');">
    <div class="hero-overlay"></div>
    <div class="container text-center hero-content">
        <h2 data-traducible="Gestión de Horarios" class="display-6 fw-semibold">Gestión de Horarios</h2>
        <p data-traducible="Desde aquí puedes agregar, visualizar y administrar los horarios del sistema" class="mb-4">
            Desde aquí puedes agregar, visualizar y administrar los horarios del sistema
        </p>
        <div class="d-flex justify-content-center gap-3">
            <button class="btn btn-light btn-lg btn_wicon" data-bs-toggle="modal" data-bs-target="#agregarHorarioModal">
                <i class="bi bi-calendar-plus-fill"></i>
                <span data-traducible="Agregar Horario">Agregar Horario</span>
            </button>
        </div>
    </div>
</div>


<div id="HeroCursos" class="hero hero-imagen text-white py-5 d-flex align-items-center justify-content-center" 
     style="background-image: url('https://images.unsplash.com/photo-1512314889357-e157c22f938d?q=80&w=2071&auto=format&fit=crop');">
    <div class="hero-overlay"></div>
    <div class="container text-center hero-content">
        <h2 data-traducible="Cursos" class="display-6 fw-semibold">Cursos</h2>
        <p data-traducible="Desde aquí puedes agregar nuevos cursos al sistema" class="mb-4">
            Desde aquí puedes agregar nuevos cursos al sistema
        </p>
        <div class="d-flex justify-content-center gap-3">
            <button class="btn btn-light btn-lg btn_wicon" data-bs-toggle="modal" data-bs-target="#agregarCursoModal">
                <i class="bi bi-file-earmark-plus-fill"></i>
                <span data-traducible="Agregar Curso">Agregar Curso</span>
            </button>
            <a href="../PaginasAdcriptas/cursos.php" class="btn btn-outline-light btn-lg" data-traducible="Ver Cursos">Ver Cursos</a>
        </div>
    </div>
</div>

<div id="HeroGrupos" class="hero hero-imagen text-white py-5 d-flex align-items-center justify-content-center" 
     style="background-image: url('https://images.unsplash.com/photo-1529070538774-1843cb3265df?q=80&w=2070&auto=format&fit=crop');">
    <div class="hero-overlay"></div>
    <div class="container text-center hero-content">
        <h2 data-traducible="Gestión de Grupos" class="display-6 fw-semibold">Gestión de Grupos</h2>
        <p data-traducible="Desde aquí puedes agregar nuevos grupos al sistema" class="mb-4">
            Desde aquí puedes agregar nuevos grupos al sistema
        </p>
        <div class="d-flex justify-content-center gap-3">
            <button class="btn btn-light btn-lg btn_wicon" data-bs-toggle="modal" data-bs-target="#agregarGrupoModal">
                <i class="bi bi-people-fill"></i>
                <span data-traducible="Agregar Grupo">Agregar Grupo</span>
            </button>
            <a href="../PaginasAdcriptas/grupos.php" class="btn btn-outline-light btn-lg" data-traducible="Ver Grupos">Ver Grupos</a>
        </div>
    </div>
</div>

<div class="hero hero-imagen text-white py-5 d-flex align-items-center justify-content-center" 
     style="background-image: url('https://images.unsplash.com/photo-1587691592099-24045742c181?q=80&w=2073&auto=format&fit=crop');">
    <div class="hero-overlay"></div>
    <div class="container text-center hero-content">
        <h2 data-traducible="Asignaturas" class="display-6 fw-semibold">Asignaturas</h2>
        <p data-traducible="Desde aquí puedes gestionar las asignaturas registradas en el sistema" class="mb-4">
            Desde aquí puedes gestionar las asignaturas registradas en el sistema
        </p>
        <div class="d-flex justify-content-center gap-3">
            <button class="btn btn-light btn-lg btn_wicon" data-bs-toggle="modal" data-bs-target="#agregarAsignaturaModal">
                <i class="bi bi-journal-plus"></i>
                <span data-traducible="Agregar Asignatura">Agregar Asignatura</span>
            </button>
            <a href="../PaginasAdcriptas/asignaturas.php" class="btn btn-outline-light btn-lg" data-traducible="Ver Asignaturas">Ver Asignaturas</a>
        </div>
    </div>
</div>

<?php include '../tools/sections/seccion_horarios.php'; ?>

<!-- Hero Recursos -->
<div id="HeroRecursos" class="hero hero-imagen text-white py-5 d-flex align-items-center justify-content-center" 
     style="background-image: url('https://images.unsplash.com/photo-1512314889357-e157c22f938d?q=80&w=2071&auto=format&fit=crop');">
    <div class="hero-overlay"></div>
    <div class="container text-center hero-content">
        <h2 class="display-6 fw-semibold">Recursos</h2>
        <p data-traducible="Desde aquí puedes agregar nuevos Recursos al sistema" class="mb-4">
            Desde aquí puedes agregar nuevos recursos al sistema
        </p>
        <div class="d-flex justify-content-center gap-3">
            <button class="btn btn-light btn-lg btn_wicon" data-bs-toggle="modal" data-bs-target="#agregarRecursoModal">
                <i class="bi bi-file-earmark-plus-fill"></i>
                <span data-traducible="Agregar Recurso">Agregar Recurso</span>
            </button>
            <a href="../PaginasAdcriptas/recursos.php" class="btn btn-outline-light btn-lg" data-traducible="Ver Recursos">Ver Recursos</a>
        </div>
    </div>
</div>


<!--  Modal Agregar Recurso -->
<div class="modal fade" id="agregarRecursoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="../PaginasAdcriptas/agregar_recurso.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" data-traducible="Agregar Nuevo Recurso">Agregar Nuevo Recurso</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>

<div class="modal-body">
  <div class="mb-3">
    <label class="form-label" data-traducible="Nombre del Recurso">Nombre del Recurso</label>
    <input type="text" name="nombre_recurso" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label" data-traducible="Tipo">Tipo</label>
    <input type="text" name="tipo" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label" data-traducible="Asignar al Espacio">Asignar al Espacio</label>
    <select name="id_espacio" class="form-select" required>
      <option value="" selected disabled>Seleccione un espacio</option>
      <?php
      include '../login/conexion_bd.php';
      $sql = "SELECT id_espacio, nombre_espacio, tipo FROM espacio ORDER BY nombre_espacio ASC";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $nombre = htmlspecialchars($row['nombre_espacio'] . ' (' . $row['tipo'] . ')');
              echo "<option value='{$row['id_espacio']}'>{$nombre}</option>";
          }
      }
      ?>
    </select>
  </div>
</div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-traducible="Cancelar">Cancelar</button>
          <button type="submit" class="btn btn-primary" data-traducible="Agregar">Agregar</button>
        </div>
      </form>
    </div>
  </div>
</div>  


<div id="HeroEspacios" class="hero hero-imagen text-white py-5 d-flex align-items-center justify-content-center" 
     style="background-image: url('https://images.unsplash.com/photo-1604134967494-8a9ed3adea0d?q=80&w=1974&auto=format&fit=crop');">
    <div class="hero-overlay"></div>
    <div class="container text-center hero-content">
        <h2 data-traducible="Gestión de Espacios" class="display-6 fw-semibold">Gestión de Espacios</h2>
        <p data-traducible="Desde aquí podés agregar nuevos espacios al sistema y asignarles recursos" class="mb-4">
            Desde aquí podés agregar nuevos espacios al sistema y asignarles recursos
        </p>
        <div class="d-flex justify-content-center gap-3">
            <button class="btn btn-light btn-lg btn_wicon" data-bs-toggle="modal" data-bs-target="#agregarEspacioModal">
                <i class="bi bi-clipboard-plus-fill"></i>
                <span data-traducible="Agregar Espacio">Agregar Espacio</span>
            </button>
        </div>
    </div>
</div>

<?php include '../tools/sections/seccion_reservas.php'; ?>

<a href="#top" id="scrollTopBtn" class="btn btn-secondary shadow-lg position-fixed bottom-0 end-0 m-4" 
   style="z-index:999; font-size:28px; opacity:0; transform: translateY(20px); transition: opacity 0.5s, transform 0.5s;">
    <i class="bi bi-caret-up-fill"></i>
</a>

<!-- TODOS LOS MODALES -->
<?php include '../tools/modales/modales_adscripta.php'; ?>

<?php include '../tools/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/modoClaroOscuro.js"></script>
<script src="../../js/traductor.js"></script>
<script src="../../js/adscripta-scripts.js"></script>
<script src="../../js/notificaciones-adscripta.js"></script>
<script src="../../js/scroll-top.js"></script>

</body>
</html>