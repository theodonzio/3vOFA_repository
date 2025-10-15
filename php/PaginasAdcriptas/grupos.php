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

<?php
include '../tools/head.php';
include '../login/conexion_bd.php';

// Obtener todos los grupos (con su curso y turno)
$sql = "SELECT g.id_grupo, g.nombre_grupo, g.anio_curso, c.nombre_curso, t.nombre_turno
        FROM grupo g
        LEFT JOIN curso c ON g.id_curso = c.id_curso
        LEFT JOIN turno t ON g.id_turno = t.id_turno
        ORDER BY g.id_grupo ASC";
$result = $conn->query($sql);
?>
<!-- Hero Grupos -->
<div class="hero text-white py-5 d-flex align-items-center justify-content-center"
     style="background-image: url('https://images.unsplash.com/photo-1529070538774-1843cb3265df?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); 
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
    <h2 class="display-6 fw-semibold" data-traducible="Lista de Grupos Registrados">Lista de Grupos Registrados</h2>
    <p class="mb-4" data-traducible="Aquí puedes ver y gestionar los grupos del sistema">Aquí puedes ver y gestionar los grupos del sistema</p>

    <div class="d-flex justify-content-center gap-3">
      <a href="../usuarios/adscripta.php" 
         class="btn btn-outline-light px-3 py-2"
         style="font-size: 0.95rem;"
         data-traducible="Volver al Panel"
         >
       Volver al Panel
      </a>
    </div>
  </div>
</div>


<div class="mb-5 hero">
  <div class="shadow-lg border-0 rounded-4" id="tabla_grupos">
    <div>
      <?php if ($result && $result->num_rows > 0): ?>
        <div class="table-responsive">
          <table class="table table-hover align-middle text-center table-striped mb-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Año</th>
                <th>Curso</th>
                <th>Turno</th>
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
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <div class="text-center py-4">
          <i class="bi bi-exclamation-circle fs-1 text-secondary"></i>
          <h5 class="mt-3">No hay grupos registrados</h5>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
  });
</script>

<script src="../../js/modoClaroOscuro.js"></script>
<script src="../../js/traductor.js"></script>

</body>

<?php include '../tools/footer.php'; ?>
</html>

<?php $conn->close(); ?>


<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/modoClaroOscuro.js"></script>
<script src="../../js/traductor.js"></script>
