<?php
// Guardar id_grupo ANTES de incluir cualquier cosa
$id_grupo_actual = isset($_GET['id_grupo']) ? intval($_GET['id_grupo']) : 0;

include '../tools/head.php';
include '../login/conexion_bd.php';
include '../tools/headers/header_estudiante.php';
?>

<link rel="stylesheet" href="../../css/style.css">
<body>

<div class="container text-center my-5">
    <div class="mb-4">
        <i class="bi bi-calendar-week icon-calendar-main"></i>
    </div>
    <h1 class="display-4 fw-bold text-primary mb-3" id="tituloGrupo" data-traducible="Cargando...">Cargando...</h1>
    <p class="lead text-muted mb-4" id="subtituloGrupo" data-traducible="Aquí verás tu horario académico">Aquí verás tu horario académico</p>
    <div id="watch" class="reloj text-center mt-2 fs-4 fw-semibold text-primary" data-traducible="Reloj"></div>
</div>

<div class="container my-5">
  <div id="tablaHorariosContainer" style="display: none;">
    <div class="table-responsive shadow rounded">
      <table class="table table-bordered text-center align-middle table-hover mb-0">
        <thead class="table-primary">
          <tr>
            <th style="width: 15%;" data-traducible="Hora">Hora</th>
            <th data-traducible="Lunes">Lunes</th>
            <th data-traducible="Martes">Martes</th>
            <th data-traducible="Miércoles">Miércoles</th>
            <th data-traducible="Jueves">Jueves</th>
            <th data-traducible="Viernes">Viernes</th>
          </tr>
        </thead>
        <tbody id="cuerpoTabla"></tbody>
      </table>
    </div>
  </div>

  <div id="mensajeVacio" class="text-center py-5">
    <p class="fs-5 text-muted" data-traducible="Selecciona un grupo para ver tu horario">Selecciona un grupo para ver tu horario</p>
  </div>
</div>

<?php include '../tools/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/traductor.js"></script>
<script src="../../js/modoClaroOscuro.js"></script>
<script src="../../js/scroll-top.js"></script>
<script src="../../js/watchFunction.js"></script>
<script src="../../js/estudiante.js"></script>
<script src="../../js/timeout.js"></script>

</body>
</html>
