<?php
session_start();

// Verifica sesión
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../../index.php?login=" . (!isset($_SESSION['id_usuario']) ? 'required' : 'unauthorized'));
    exit;
}

include '../tools/head.php';
include '../login/conexion_bd.php';

// Obtiene todos los grupos (con su curso y turno) incluyendo ids para usar en los modales
$sql = "SELECT g.id_grupo, g.nombre_grupo, g.anio_curso, g.id_curso, g.id_turno, c.nombre_curso, t.nombre_turno
        FROM grupo g
        LEFT JOIN curso c ON g.id_curso = c.id_curso
        LEFT JOIN turno t ON g.id_turno = t.id_turno
        ORDER BY g.id_grupo ASC";
$result = $conn->query($sql);

// Obtiene lista de cursos y turnos para los select de los modales
$cursos = $conn->query("SELECT id_curso, nombre_curso FROM curso ORDER BY nombre_curso ASC");
$turnos = $conn->query("SELECT id_turno, nombre_turno FROM turno ORDER BY id_turno ASC");
?>

<link rel="stylesheet" href="../../css/style.css">
<link rel="stylesheet" href="../../css/lista_grupos.css">

<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
           <div class="logo me-auto">
        <a href="../../php/index.php"><img src="../../img/ofalogos/fulltextnegativo.png" id="logo-barra"></a>
        <div class="dropdown">
          <img 
            src="../img/icons/config_icon(black).png"
            class="theme_icon_mode dropdown-toggle"
            id="boton-tema"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="boton-tema">
            <li><h6 class="dropdown-header" data-traducible="Tema">Tema</h6></li>
            <li><a class="dropdown-item" href="#" id="tema-claro" data-traducible="Claro"><img class="icono">Claro</a></li>
            <li><a class="dropdown-item" href="#" id="tema-oscuro" data-traducible="Oscuro"><img class="icono">Oscuro</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><h6 class="dropdown-header" data-traducible="Lenguaje">Lenguaje</h6></li>
            <li><a class="dropdown-item" href="#" id="lenguaje-es" data-traducible="Español">Español</a></li>
            <li><a class="dropdown-item" href="#" id="lenguaje-en" data-traducible="Inglés">Inglés</a></li>
          </ul>
        </div>
      </div>
      </div>
  </nav>
</header>

<body>

<!-- Hero Grupos -->
<div class="hero-grupos text-white py-5 d-flex align-items-center justify-content-center hero">
  <div class="hero-overlay"></div>

  <div class="container text-center hero-content">
    <h2 class="display-6 fw-semibold" data-traducible="Lista de Grupos Registrados">Lista de Grupos Registrados</h2>
    <p class="mb-4" data-traducible="Aquí puedes ver y gestionar los grupos del sistema">Aquí puedes ver y gestionar los grupos del sistema</p>

    <div class="d-flex justify-content-center gap-3">
      <a href="../usuarios/adscripta.php" 
         class="btn btn-outline-light btn-volver"
         data-traducible="Volver al Panel">
       Volver al Panel
      </a>
    </div>
  </div>
</div>

<!-- Mensajes simples -->
<div class="container mt-4">
  <?php if (isset($_GET['edit']) && $_GET['edit'] === 'success'): ?>
    <div class="alert alert-success">Grupo actualizado correctamente.</div>
  <?php endif; ?>
  <?php if (isset($_GET['delete']) && $_GET['delete'] === 'success'): ?>
    <div class="alert alert-success">Grupo eliminado correctamente.</div>
  <?php endif; ?>
</div>

<!-- Tabla Grupos -->
<div class="mb-5 hero">
  <div class="shadow-lg border-0 rounded-4" id="tabla_grupos">
    <div>
      <?php if ($result && $result->num_rows > 0): ?>
        <div class="table-responsive">
          <table class="table table-hover align-middle text-center table-striped mb-0">
            <thead>
              <tr>
                <th data-traducible="ID">ID</th>
                <th data-traducible="Nombre">Nombre</th>
                <th data-traducible="Año">Año</th>
                <th data-traducible="Curso">Curso</th>
                <th data-traducible="Turno">Turno</th>
                <th data-traducible="Acciones">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                  <td><?= htmlspecialchars($row['id_grupo']) ?></td>
                  <td><?= htmlspecialchars($row['nombre_grupo']) ?></td>
                  <td><?= htmlspecialchars($row['anio_curso']) ?></td>
                  <td><?= htmlspecialchars($row['nombre_curso'] ?? '—') ?></td>
                  <td><?= htmlspecialchars($row['nombre_turno'] ?? '—') ?></td>
                  <td>
                    <!-- Botón Editar -->
                    <button class="btn btn-warning btn-sm me-1"
                            data-bs-toggle="modal"
                            data-bs-target="#editarGrupoModal<?= $row['id_grupo'] ?>"
                            title="Editar"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top">
                      <i class="bi bi-pencil-square"></i>
                    </button>

                    <!-- Botón Eliminar -->
                   <button 
  class="btn btn-danger btn-sm eliminar-grupo"
  data-id="<?= htmlspecialchars($row['id_grupo']) ?>"
  data-nombre="<?= htmlspecialchars($row['nombre_grupo']) ?>"
  title="Eliminar"
  data-bs-toggle="tooltip"
  data-bs-placement="top">
  <i class="bi bi-trash"></i>
</button>
                  </td>
                </tr>

                <!-- Modal Editar por cada grupo -->
<div class="modal fade" id="editarGrupoModal<?= $row['id_grupo'] ?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="editar_grupo.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" data-traducible="Editar Grupo">Editar Grupo #<?= htmlspecialchars($row['id_grupo']) ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_grupo" value="<?= htmlspecialchars($row['id_grupo']) ?>">

          <div class="mb-3">
            <label class="form-label" data-traducible="Nombre">Nombre</label>
            <input type="text" name="nombre_grupo" class="form-control" value="<?= htmlspecialchars($row['nombre_grupo']) ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label" data-traducible="Año">Año</label>
            <input type="number" name="anio_curso" class="form-control" min="0" value="<?= htmlspecialchars($row['anio_curso']) ?>">
          </div>

          <div class="mb-3">
            <label class="form-label" data-traducible="Curso">Curso</label>
            <select name="id_curso" class="form-select">
              <option value="" data-traducible="-- Seleccionar curso --">-- Seleccionar curso --</option>
              <?php
              if ($cursos && $cursos->num_rows > 0) {
                  $cursos->data_seek(0);
                  while ($c = $cursos->fetch_assoc()) {
                      $sel = ($row['id_curso'] == $c['id_curso']) ? 'selected' : '';
                      echo '<option value="' . htmlspecialchars($c['id_curso']) . "\" $sel>" . htmlspecialchars($c['nombre_curso']) . '</option>';
                  }
                  $cursos->data_seek(0);
              }
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label" data-traducible="Turno">Turno</label>
            <select name="id_turno" class="form-select">
              <option value="" data-traducible="-- Seleccionar turno --">-- Seleccionar turno --</option>
              <?php
              if ($turnos && $turnos->num_rows > 0) {
                  $turnos->data_seek(0);
                  while ($t = $turnos->fetch_assoc()) {
                      $sel = ($row['id_turno'] == $t['id_turno']) ? 'selected' : '';
                      echo '<option value="' . htmlspecialchars($t['id_turno']) . "\" $sel>" . htmlspecialchars($t['nombre_turno']) . '</option>';
                  }
                  $turnos->data_seek(0);
              }
              ?>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-traducible="Cancelar">Cancelar</button>
          <button type="submit" class="btn btn-primary" data-traducible="Guardar cambios">Guardar cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>
                <!-- /Modal Editar -->

              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <div class="text-center py-4">
          <i class="bi bi-exclamation-circle fs-1 text-secondary"></i>
          <h5 class="mt-3" data-traducible="No hay grupos registrados">No hay grupos registrados</h5>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/modoClaroOscuro.js"></script>
<script src="../../js/traductor.js"></script>
<script src="../../js/grupos.js"></script>
<script src="../../js/notificaciones-grupos.js"></script>
<script src="../../../js/timeout.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php include '../tools/footer.php'; ?>
<?php $conn->close(); ?>

</body>
</html>