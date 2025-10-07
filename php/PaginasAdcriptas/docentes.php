<?php
include '../tools/head.php';
include '../tools/header_adscripta.php';
include '../login/conexion_bd.php';

// Obtener todos los docentes (id_rol = 2)
$sql = "SELECT id_usuario, nombre, apellido, cedula, email FROM Usuario WHERE id_rol = 2";
$result = $conn->query($sql);
?>
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
    <h2 class="display-6 fw-semibold">Lista de Docentes Registrados</h2>
    <p class="mb-4">Aquí puedes ver y gestionar a los docentes registrados en el sistema</p>

    <div class="d-flex justify-content-center gap-3">
      <a href="../usuarios/adscripta.php" 
         class="btn btn-outline-light px-3 py-2"
         style="font-size: 0.95rem;">
       Volver al Panel
      </a>
    </div>
  </div>
</div>


<div class="mb-5 hero">
  <div class="shadow-lg border-0 rounded-4" id="tabla_docentes">
    <div>
      <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
          <table class="table table-hover align-middle text-center table-striped mb-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cédula</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                  <td><?= $row['id_usuario'] ?></td>
                  <td><?= htmlspecialchars($row['nombre']) ?></td>
                  <td><?= htmlspecialchars($row['apellido']) ?></td>
                  <td><?= htmlspecialchars($row['cedula']) ?></td>
                  <td><?= htmlspecialchars($row['email']) ?></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <div class="text-center py-4">
          <i class="bi bi-exclamation-circle fs-1 text-secondary"></i>
          <h5 class="mt-3">No hay docentes registrados</h5>
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

</body>

<?php include '../tools/footer.php'; ?>
</html>

<?php $conn->close(); ?>