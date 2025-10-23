<?php
session_start();

// Verificar sesión
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../../index.php?login=" . (!isset($_SESSION['id_usuario']) ? 'required' : 'unauthorized'));
    exit;
}

include '../tools/head.php';
include '../login/conexion_bd.php';

// Consulta para obtener todas las asignaturas con su docente y grupo
$sql = "
  SELECT a.id_asignatura, a.nombre_asignatura,
         CONCAT(u.nombre, ' ', u.apellido) AS docente,
         g.nombre_grupo AS grupo
  FROM asignatura a
  LEFT JOIN grupo_asignatura ga ON a.id_asignatura = ga.id_asignatura
  LEFT JOIN usuario u ON ga.id_docente = u.id_usuario
  LEFT JOIN grupo g ON ga.id_grupo = g.id_grupo
  ORDER BY a.id_asignatura ASC
";
$result = $conn->query($sql);
?>

<link rel="stylesheet" href="../../css/style.css">

<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <div class="logo">
        <img src="../../img/ofalogos/fulltextnegativo.png" id="logo-barra">

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
            <li><a class="dropdown-item" href="#" id="tema-claro" data-traducible="Claro">Claro</a></li>
            <li><a class="dropdown-item" href="#" id="tema-oscuro" data-traducible="Oscuro">Oscuro</a></li>
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

<!-- Hero Asignaturas -->
<div class="hero text-white py-5 d-flex align-items-center justify-content-center hero-asignaturas">
  <div class="hero-overlay"></div>

  <div class="container text-center hero-content">
    <h2 class="display-6 fw-semibold" data-traducible="Asignaturas">Asignaturas</h2>
    <p class="mb-4" data-traducible="Visualiza todas las asignaturas registradas en el sistema">
      Visualiza todas las asignaturas registradas en el sistema
    </p>

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
    <div class="alert alert-success">Asignatura actualizada correctamente.</div>
  <?php endif; ?>
  <?php if (isset($_GET['delete']) && $_GET['delete'] === 'success'): ?>
    <div class="alert alert-success">Asignatura eliminada correctamente.</div>
  <?php endif; ?>
</div>

<!-- Tabla de Asignaturas -->
<div class="mb-5 hero">
  <div class="shadow-lg border-0 rounded-4" id="tabla_asignaturas">
    <div>
      <?php if ($result && $result->num_rows > 0): ?>
        <div class="table-responsive">
          <table class="table table-hover align-middle text-center table-striped mb-0">
            <thead>
              <tr>
                <th>ID</th>
                <th data-traducible="Nombre de la Asignatura">Nombre de la Asignatura</th>
                <th data-traducible="Docente">Docente</th>
                <th data-traducible="Grupo">Grupo</th>
                <th data-traducible="Acciones">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                  <td><?= htmlspecialchars($row['id_asignatura']) ?></td>
                  <td><?= htmlspecialchars($row['nombre_asignatura']) ?></td>
                  <td><?= htmlspecialchars($row['docente'] ?? '—') ?></td>
                  <td><?= htmlspecialchars($row['grupo'] ?? '—') ?></td>
                  <td>
                    <!-- Botón Editar -->
                    <button class="btn btn-warning btn-sm me-1" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editarAsignaturaModal<?= $row['id_asignatura'] ?>"
                            title="Editar">
                      <i class="bi bi-pencil-square"></i>
                    </button>

                    <!-- Botón Eliminar -->
                    <a href="eliminar_asignatura.php?id=<?= urlencode($row['id_asignatura']) ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('¿Seguro que deseas eliminar la asignatura <?= addslashes(htmlspecialchars($row['nombre_asignatura'])) ?>?');"
                       title="Eliminar">
                      <i class="bi bi-trash"></i>
                    </a>
                  </td>
                </tr>

                <!-- Modal Editar -->
                <div class="modal fade" id="editarAsignaturaModal<?= $row['id_asignatura'] ?>" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <form action="editar_asignatura.php" method="POST">
                        <div class="modal-header">
                          <h5 class="modal-title">Editar Asignatura #<?= htmlspecialchars($row['id_asignatura']) ?></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="id_asignatura" value="<?= htmlspecialchars($row['id_asignatura']) ?>">
                          <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre_asignatura" class="form-control" value="<?= htmlspecialchars($row['nombre_asignatura']) ?>" required>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-primary">Guardar cambios</button>
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
          <h5 class="mt-3" data-traducible="No hay asignaturas registradas">No hay asignaturas registradas</h5>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/modoClaroOscuro.js"></script>
<script src="../../js/traductor.js"></script>

<?php include '../tools/footer.php'; ?>
<?php $conn->close(); ?>

</body>
</html>