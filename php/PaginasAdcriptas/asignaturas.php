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

<?php
include '../tools/head.php';
include '../login/conexion_bd.php';

// Consulta para obtener todas las asignaturas con su docente y grupo
$sql = "
  SELECT a.id_asignatura, a.nombre_asignatura,
         CONCAT(u.nombre, ' ', u.apellido) AS docente,
         g.nombre_grupo AS grupo
  FROM asignatura a
  LEFT JOIN usuario u ON a.id_docente = u.id_usuario
  LEFT JOIN grupo g ON a.id_grupo = g.id_grupo
  ORDER BY a.id_asignatura ASC
";
$result = $conn->query($sql);
?>

<!-- Hero Asignaturas -->
<div class="hero text-white py-5 d-flex align-items-center justify-content-center"
     style="background-image: url('https://images.unsplash.com/photo-1587691592099-24045742c181?q=80&w=2073&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            position: relative;
            min-height: 400px;
            border-radius: 20px;">

  <div style="position: absolute; top:0; left:0; right:0; bottom:0;
              background: rgba(0,0,0,0.4);
              border-radius: 20px;"></div>

  <div class="container text-center" style="position: relative; z-index: 1; max-width: 900px;">
    <h2 class="display-6 fw-semibold" data-traducible="Asignaturas">Asignaturas</h2>
    <p class="mb-4" data-traducible="Visualiza todas las asignaturas registradas en el sistema">
      Visualiza todas las asignaturas registradas en el sistema
    </p>

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
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                  <td><?= htmlspecialchars($row['id_asignatura']) ?></td>
                  <td><?= htmlspecialchars($row['nombre_asignatura']) ?></td>
                  <td><?= htmlspecialchars($row['docente'] ?? '—') ?></td>
                  <td><?= htmlspecialchars($row['grupo'] ?? '—') ?></td>
                </tr>
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
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
  });
</script>

<script src="../../js/modoClaroOscuro.js"></script>
<script src="../../js/traductor.js"></script>

<?php include '../tools/footer.php'; ?>
<?php $conn->close(); ?>
</body>
</html>
