<?php
session_start();

// Verifica sesión
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../../index.php?login=" . (!isset($_SESSION['id_usuario']) ? 'required' : 'unauthorized'));
    exit;
}

include '../tools/head.php';
include '../login/conexion_bd.php';

$sql = "SELECT * FROM curso ORDER BY id_curso ASC";
$result = $conn->query($sql);
?>

<link rel="stylesheet" href="../../css/style.css">
<link rel="stylesheet" href="../../css/cursos.css">

<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
           <div class="logo me-auto">
        <a href="../../php/index.php"><img src="../../img/ofalogos/fulltextnegativo.png" id="logo-barra"></a>
        <div class="dropdown">
          <img 
            src="../../img/icons/config_icon(black).png"
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

<!-- Hero Cursos -->
<div class="hero text-white py-5 d-flex align-items-center justify-content-center hero-cursos">
  <div class="hero-overlay"></div>

  <div class="container text-center hero-content">
    <h2 class="display-6 fw-semibold" data-traducible="Lista de Cursos Registrados">Lista de Cursos Registrados</h2>
    <p class="mb-4" data-traducible="Aquí puedes ver los cursos del sistema">Aquí puedes ver los cursos del sistema</p>

    <div class="d-flex justify-content-center gap-3">
      <a href="../usuarios/adscripta.php" 
         class="btn btn-outline-light px-3 py-2 btn-volver"
         data-traducible="Volver al Panel">
        Volver al Panel
      </a>
    </div>
  </div>
</div>

<!-- Mensajes simples -->
<div class="container mt-4">
  <?php if (isset($_GET['edit']) && $_GET['edit'] === 'success'): ?>
    <div class="alert alert-success">Curso actualizado correctamente.</div>
  <?php endif; ?>
  <?php if (isset($_GET['delete']) && $_GET['delete'] === 'success'): ?>
    <div class="alert alert-success">Curso eliminado correctamente.</div>
  <?php endif; ?>
</div>

<!-- Tabla Cursos -->
<div class="mb-5 hero">
  <div class="shadow-lg border-0 rounded-4" id="tabla_cursos">
    <div>
      <?php if ($result && $result->num_rows > 0): ?>
        <div class="table-responsive">
          <table class="table table-hover align-middle text-center table-striped mb-0">
            <thead>
              <tr>
                <th data-traducible="ID">ID</th>
                <th data-traducible="Nombre">Nombre</th>
                <th data-traducible="Descripción">Descripción</th>
                <th data-traducible="Duración (Años)">Duración (Años)</th>
                <th data-traducible="Acciones">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                  <td><?= htmlspecialchars($row['id_curso']) ?></td>
                  <td><?= htmlspecialchars($row['nombre_curso']) ?></td>
                  <td><?= htmlspecialchars($row['descripcion'] ?: '—') ?></td>
                  <td><?= htmlspecialchars($row['duracion_anos'] ?: '—') ?></td>
                  <td>
                    <!-- Botón Editar (abre modal único por fila) -->
                    <button class="btn btn-warning btn-sm me-1" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editarCursoModal<?= $row['id_curso'] ?>"
                            title="Editar">
                      <i class="bi bi-pencil-square"></i>
                    </button>

                    <!-- Botón Eliminar -->
                    <button 
  class="btn btn-danger btn-sm eliminar-curso" 
  data-id="<?= htmlspecialchars($row['id_curso']) ?>" 
  data-nombre="<?= htmlspecialchars($row['nombre_curso']) ?>"
  title="Eliminar">
  <i class="bi bi-trash"></i>
</button>
                  </td>
                </tr>

                <!-- Modal Editar por cada fila -->
<div class="modal fade" id="editarCursoModal<?= $row['id_curso'] ?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="editar_curso.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" data-traducible="Editar Curso">Editar Curso #<?= htmlspecialchars($row['id_curso']) ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_curso" value="<?= htmlspecialchars($row['id_curso']) ?>">
          <div class="mb-3">
            <label class="form-label" data-traducible="Nombre">Nombre</label>
            <input type="text" name="nombre_curso" class="form-control" value="<?= htmlspecialchars($row['nombre_curso']) ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label" data-traducible="Descripción">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3"><?= htmlspecialchars($row['descripcion']) ?></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label" data-traducible="Duración (Años)">Duración (Años)</label>
            <input type="number" min="0" name="duracion_anos" class="form-control" value="<?= htmlspecialchars($row['duracion_anos']) ?>">
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
          <h5 class="mt-3" data-traducible="No hay cursos registrados">No hay cursos registrados</h5>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/modoClaroOscuro.js"></script>
<script src="../../js/traductor.js"></script>
<script src="../../js/notificaciones-curso.js"></script>
<script src="../../../js/timeout.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php include '../tools/footer.php'; ?>
<?php $conn->close(); ?>

</body>
</html>