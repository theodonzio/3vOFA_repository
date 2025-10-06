<?php
include '../tools/head.php';
include '../tools/header_docente.php';
include '../login/conexion_bd.php';

// Obtener todos los docentes (id_rol = 2)
$sql = "SELECT id_usuario, nombre, apellido, cedula, email FROM Usuario WHERE id_rol = 2";
$result = $conn->query($sql);
?>

<!-- CONTENIDO DE LA PÁGINA -->
<div class="container py-5" id="docentetable">
    <h1 class="text-center mb-4">Lista de Docentes Registrados</h1>

    <div class="text-center mb-4">
        <a href="../usuarios/adscripta.php" class="btn btn-outline-light">
            ⬅ Volver
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle text-center rounded">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Cédula</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id_usuario'] ?></td>
                            <td><?= htmlspecialchars($row['nombre']) ?></td>
                            <td><?= htmlspecialchars($row['apellido']) ?></td>
                            <td><?= htmlspecialchars($row['cedula']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No hay docentes registrados</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- SCRIPTS AL FINAL (antes de cerrar body) -->
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
</html>

<?php $conn->close(); ?>
