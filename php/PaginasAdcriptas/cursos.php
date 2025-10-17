<?php
session_start();

// Verificar sesión
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
<div class="hero text-white py-5 d-flex align-items-center justify-content-center"
     style="background-image: url('https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            position: relative;
            min-height: 400px;
            border-radius: 20px;">

  <div style="position: absolute; top:0; left:0; right:0; bottom:0;
              background: rgba(0,0,0,0.4);
              border-radius: 20px;"></div>

  <div class="container text-center" style="position: relative; z-index: 1; max-width: 900px;">
    <h2 class="display-6 fw-semibold" data-traducible="Lista de Cursos Registrados">Lista de Cursos Registrados</h2>
    <p class="mb-4" data-traducible="Aquí puedes ver los cursos del sistema">Aquí puedes ver los cursos del sistema</p>

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
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                  <td><?= htmlspecialchars($row['id_curso']) ?></td>
                  <td><?= htmlspecialchars($row['nombre_curso']) ?></td>
                  <td><?= htmlspecialchars($row['descripcion'] ?: '—') ?></td>
                  <td><?= htmlspecialchars($row['duracion_anos'] ?: '—') ?></td>
                </tr>
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

<?php include '../tools/footer.php'; ?>
<?php $conn->close(); ?>

</body>
</html>