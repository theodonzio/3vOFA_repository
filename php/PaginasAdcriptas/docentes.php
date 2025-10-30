<?php
session_start();

// Verificar sesión (mismo comportamiento que en los otros archivos)
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../../index.php?login=" . (!isset($_SESSION['id_usuario']) ? 'required' : 'unauthorized'));
    exit;
}

include '../tools/head.php';
include '../login/conexion_bd.php';

// Obtener todos los docentes (id_rol = 2)
$sql = "SELECT id_usuario, nombre, apellido, cedula, email FROM usuario WHERE id_rol = 2 ORDER BY id_usuario ASC";
$result = $conn->query($sql);
?>

<link rel="stylesheet" href="../../css/style.css">

<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <div class="logo">
        <img src="../img/ofalogos/fulltextnegativo.png" id="logo-barra">
        
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

<!-- Hero Docentes -->
<div class="hero text-white py-5 d-flex align-items-center justify-content-center"
     style="background-image: url('https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=2070&auto=format&fit=crop'); 
            background-size: cover; 
            background-position: center; 
            position: relative; 
            min-height: 400px; 
            border-radius: 20px;">
  
  <!-- Overlay oscuro -->
  <div style="position: absolute; top:0; left:0; right:0; bottom:0; 
              background: rgba(0,0,0,0.4); 
              border-radius: 20px;"></div>

  <!-- Contenido del Hero -->
  <div class="container text-center" style="position: relative; z-index: 1; max-width: 900px;">
    <h2 class="display-6 fw-semibold" data-traducible="Lista de Docentes Registrados">Lista de Docentes Registrados</h2>
    <p class="mb-4" data-traducible="Aquí puedes ver y gestionar a los docentes registrados en el sistema">Aquí puedes ver y gestionar a los docentes registrados en el sistema</p>

    <div class="d-flex justify-content-center gap-3">
      <a href="../usuarios/adscripta.php" 
         class="btn btn-outline-light px-3 py-2"
         style="font-size: 0.95rem;"
         data-traducible="Volver al Panel">
        Volver al Panel
      </a>
    </div>
  </div>
</div>

<!-- Mensajes simples -->
<div class="container mt-4">
  <?php if (isset($_GET['edit']) && $_GET['edit'] === 'success'): ?>
    <div class="alert alert-success">Docente actualizado correctamente.</div>
  <?php endif; ?>
  <?php if (isset($_GET['delete']) && $_GET['delete'] === 'success'): ?>
    <div class="alert alert-success">Docente eliminado correctamente.</div>
  <?php endif; ?>
</div>

<!-- Tabla Docentes -->
<div class="mb-5 hero">
  <div class="shadow-lg border-0 rounded-4" id="tabla_docentes">
    <div>
      <?php if ($result && $result->num_rows > 0): ?>
        <div class="table-responsive">
          <table class="table table-hover align-middle text-center table-striped mb-0">
            <thead>
              <tr>
                <th data-traducible="ID">ID</th>
                <th data-traducible="Nombre">Nombre</th>
                <th data-traducible="Apellido">Apellido</th>
                <th data-traducible="Cédula">Cédula</th>
                <th data-traducible="Email">Email</th>
                <th data-traducible="Acciones">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                  <td><?= htmlspecialchars($row['id_usuario']) ?></td>
                  <td><?= htmlspecialchars($row['nombre']) ?></td>
                  <td><?= htmlspecialchars($row['apellido']) ?></td>
                  <td><?= htmlspecialchars($row['cedula']) ?></td>
                  <td><?= htmlspecialchars($row['email']) ?></td>
                  <td>
                    <!-- Botón Editar -->
                    <button class="btn btn-warning btn-sm me-1" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editarDocenteModal<?= $row['id_usuario'] ?>"
                            title="Editar"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top">
                      <i class="bi bi-pencil-square"></i>
                    </button>

                    <!-- Botón Eliminar -->
                    <a href="eliminar_docente.php?id=<?= urlencode($row['id_usuario']) ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('¿Seguro que deseas eliminar al docente <?= addslashes(htmlspecialchars($row['nombre'] . ' ' . $row['apellido'])) ?>?');"
                       data-bs-toggle="tooltip"
                       data-bs-placement="top">
                      <i class="bi bi-trash"></i>
                    </a>
                  </td>
                </tr>

                <!-- Modal Editar por cada docente -->
                <div class="modal fade" id="editarDocenteModal<?= $row['id_usuario'] ?>" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <form action="editar_docente.php" method="POST">
                        <div class="modal-header">
                          <h5 class="modal-title" data-traducible="Editar Docente #">Editar Docente</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($row['id_usuario']) ?>">
                          <div class="mb-3">
                            <label class="form-label" data-traducible="Nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($row['nombre']) ?>" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label" data-traducible="Apellido">Apellido</label>
                            <input type="text" name="apellido" class="form-control" value="<?= htmlspecialchars($row['apellido']) ?>" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label" data-traducible="Cédula">Cédula</label>
                            <input type="text" name="cedula" class="form-control" value="<?= htmlspecialchars($row['cedula']) ?>" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label" data-traducible="Email">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($row['email']) ?>" required>
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
          <h5 class="mt-3" data-traducible="No hay docentes registrados">No hay docentes registrados</h5>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
  });
</script>

<script src="../../js/modoClaroOscuro.js"></script>
<script src="../../js/traductor.js"></script>
<script src="../../../js/session-timeout.js"></script>

<?php include '../tools/footer.php'; ?>
<?php $conn->close(); ?>

</body>
</html>
