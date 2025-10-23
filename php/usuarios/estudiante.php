<?php
// Guardar id_grupo ANTES de incluir cualquier cosa
$id_grupo_actual = isset($_GET['id_grupo']) ? intval($_GET['id_grupo']) : 0;

include '../tools/head.php';
include '../login/conexion_bd.php';
include '../tools/headers/header_estudiante.php';
?>

<link rel="stylesheet" href="../../css/style.css">
<body>

<!-- Título Principal -->
<div class="container text-center my-5">
    <div class="mb-4">
        <i class="bi bi-calendar-week icon-calendar-main"></i>
    </div>
    <h1 class="display-4 fw-bold text-primary mb-3" id="tituloGrupo">Cargando...</h1>
    <p class="lead text-muted mb-4" id="subtituloGrupo">Aquí verás tu horario académico</p>
    <div id="watch" class="reloj text-center mt-2 fs-4 fw-semibold text-primary"></div>
</div>

<!-- Contenedor de la tabla -->
<div class="container my-5">
  <div id="tablaHorariosContainer" style="display: none;">
    <div class="table-responsive shadow rounded">
      <table class="table table-bordered text-center align-middle table-hover mb-0">
        <thead class="table-primary">
          <tr>
            <th style="width: 15%;">Hora</th>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miércoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
          </tr>
        </thead>
        <tbody id="cuerpoTabla"></tbody>
      </table>
    </div>
  </div>

  <div id="mensajeVacio" class="text-center py-5">
    <i class="bi bi-calendar-event display-1 text-muted mb-3"></i>
    <p class="fs-5 text-muted">Selecciona un grupo para ver tu horario</p>
  </div>
</div>

<?php include '../tools/footer.php'; ?>

<!-- Scripts al final -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/traductor.js"></script>
<script src="../../js/modoClaroOscuro.js"></script>
<script src="../../js/scroll-top.js"></script>
<script src="../../js/watchFunction.js"></script>
<script src="../../js/estudiante.js"></script>

</body>
</html>