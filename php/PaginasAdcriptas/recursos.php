<?php
session_start();

// Verifica sesión (solo adscripta - rol 1)
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../../index.php?login=" . (!isset($_SESSION['id_usuario']) ? 'required' : 'unauthorized'));
    exit;
}

include '../tools/head.php';
include '../login/conexion_bd.php';

// Consulta los recursos
$sql = "SELECT * FROM recurso ORDER BY id_recurso ASC";
$result = $conn->query($sql);
?>

<link rel="stylesheet" href="../../css/style.css">
<link rel="stylesheet" href="../../css/lista_recursos.css">

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

<!-- Hero Recursos -->
<div class="hero-recursos text-white py-5 d-flex align-items-center justify-content-center hero">
  <div class="hero-overlay"></div>

  <div class="container text-center hero-content">
    <h2 class="display-6 fw-semibold" data-traducible="Lista de Recursos Registrados">Lista de Recursos Registrados</h2>
    <p class="mb-4" data-traducible="Aquí puedes ver los recursos del sistema">Aquí puedes ver los recursos del sistema</p>

    <div class="d-flex justify-content-center gap-3">
      <a href="../usuarios/adscripta.php" 
         class="btn btn-outline-light btn-volver"
         data-traducible="Volver al Panel">
        Volver al Panel
      </a>
    </div>
  </div>
</div>

<!-- Mensajes -->
<div class="container mt-4">
  <?php if (isset($_GET['edit']) && $_GET['edit'] === 'success'): ?>
    <div class="alert alert-success">Recurso actualizado correctamente.</div>
  <?php endif; ?>
  <?php if (isset($_GET['delete']) && $_GET['delete'] === 'success'): ?>
    <div class="alert alert-success">Recurso eliminado correctamente.</div>
  <?php endif; ?>
  <?php if (isset($_GET['edit']) && $_GET['edit'] === 'duplicate'): ?>
    <div class="alert alert-danger">Ya existe un recurso con ese nombre.</div>
  <?php endif; ?>
</div>

<!-- Tabla Recursos -->
<div class="mb-5 hero">
  <div class="shadow-lg border-0 rounded-4" id="tabla_recursos">
    <div>
      <?php if ($result && $result->num_rows > 0): ?>
        <div class="table-responsive">
          <table class="table table-hover align-middle text-center table-striped mb-0">
            <thead>
              <tr>
                <th data-traducible="ID">ID</th>
                <th data-traducible="Nombre">Nombre</th>
                <th data-traducible="Tipo">Tipo</th>
                <th data-traducible="Acciones">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                  <td><?= htmlspecialchars($row['id_recurso']) ?></td>
                  <td><?= htmlspecialchars($row['nombre_recurso']) ?></td>
                  <td><?= htmlspecialchars($row['tipo'] ?: '—') ?></td>
                  <td>
                    <!-- Botón Editar -->
                    <button class="btn btn-warning btn-sm me-1" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editarRecursoModal<?= $row['id_recurso'] ?>"
                            title="Editar">
                      <i class="bi bi-pencil-square"></i>
                    </button>

                    <!-- Botón Eliminar -->
                    <a href="eliminar_recurso.php?id=<?= urlencode($row['id_recurso']) ?>" 
                       class="btn btn-danger btn-sm btn-eliminar"
                       data-nombre="<?= addslashes(htmlspecialchars($row['nombre_recurso'])) ?>"
                       title="Eliminar">
                      <i class="bi bi-trash"></i>
                    </a>
                  </td>
                </tr>

                <!-- Modal Editar Recurso -->
                <div class="modal fade" id="editarRecursoModal<?= $row['id_recurso'] ?>" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <form action="editar_recurso.php" method="POST">
                        <div class="modal-header">
                          <h5 class="modal-title" data-traducible="Editar Recurso">Editar Recurso #<?= htmlspecialchars($row['id_recurso']) ?></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="id_recurso" value="<?= htmlspecialchars($row['id_recurso']) ?>">
                          
                          <div class="mb-3">
                            <label class="form-label" data-traducible="Nombre">Nombre</label>
                            <input type="text" name="nombre_recurso" class="form-control" value="<?= htmlspecialchars($row['nombre_recurso']) ?>" required>
                          </div>

                          <div class="mb-3">
                            <label class="form-label" data-traducible="Tipo">Tipo</label>
                            <input type="text" name="tipo" class="form-control" value="<?= htmlspecialchars($row['tipo']) ?>">
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
          <h5 class="mt-3" data-traducible="No hay recursos registrados">No hay recursos registrados</h5>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/modoClaroOscuro.js"></script>
<script src="../../js/traductor.js"></script>
<script src="../../js/recursos.js"></script>
<script src="../../../js/timeout.js"></script>

<?php include '../tools/footer.php'; ?>
<?php $conn->close(); ?>

</body>
</html>
