<?php
session_start();

// Verificar sesión
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../../index.php?login=" . (!isset($_SESSION['id_usuario']) ? 'required' : 'unauthorized'));
    exit;
}

include '../tools/head.php';
include '../login/conexion_bd.php';

// Verificar si se pasó una asignatura válida
if (!isset($_GET['id'])) {
    header("Location: asignaturas.php");
    exit;
}

$id_asignatura = intval($_GET['id']);

// Obtener información de la asignatura
$stmt = $conn->prepare("
    SELECT a.id_asignatura, a.nombre_asignatura, ga.id_docente, ga.id_grupo
    FROM asignatura a
    LEFT JOIN grupo_asignatura ga ON a.id_asignatura = ga.id_asignatura
    WHERE a.id_asignatura = ?
");
$stmt->bind_param("i", $id_asignatura);
$stmt->execute();
$result = $stmt->get_result();
$asignatura = $result->fetch_assoc();

if (!$asignatura) {
    header("Location: asignaturas.php?error=notfound");
    exit;
}

// Obtener todos los docentes
$docentes_result = $conn->query("SELECT id_usuario, nombre, apellido FROM usuario WHERE id_rol = 2 ORDER BY nombre ASC");
$docentes = $docentes_result->fetch_all(MYSQLI_ASSOC);

// Obtener todos los grupos
$grupos_result = $conn->query("SELECT id_grupo, nombre_grupo FROM grupo ORDER BY nombre_grupo ASC");
$grupos = $grupos_result->fetch_all(MYSQLI_ASSOC);

// Procesar el formulario si se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_asignatura = trim($_POST['nombre_asignatura']);
    $id_docente = intval($_POST['id_docente']);
    $id_grupo = intval($_POST['id_grupo']);

    // Actualizar tabla asignatura
    $updateAsignatura = $conn->prepare("UPDATE asignatura SET nombre_asignatura = ? WHERE id_asignatura = ?");
    $updateAsignatura->bind_param("si", $nombre_asignatura, $id_asignatura);
    $updateAsignatura->execute();

    // Actualizar relación grupo_asignatura
    $updateRelacion = $conn->prepare("
        UPDATE grupo_asignatura 
        SET id_docente = ?, id_grupo = ?
        WHERE id_asignatura = ?
    ");
    $updateRelacion->bind_param("iii", $id_docente, $id_grupo, $id_asignatura);
    $updateRelacion->execute();

    header("Location: asignaturas.php?edit=success");
    exit;
}
?>

<link rel="stylesheet" href="../../css/style.css">
<link rel="stylesheet" href="../../css/editar_asignatura.css">

<body>
<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <div class="logo">
        <img src="../../img/ofalogos/fulltextnegativo.png" id="logo-barra">

        <div class="dropdown">
          <img src="../../img/icons/config_icon(black).png" class="theme_icon_mode dropdown-toggle"
               id="boton-tema" data-bs-toggle="dropdown" aria-expanded="false">
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

<!-- Hero -->
<div class="hero-editar-asignatura text-white py-5 d-flex align-items-center justify-content-center">
  <div class="hero-overlay"></div>

  <div class="container text-center hero-content">
    <h2 class="display-6 fw-semibold" data-traducible="Editar Asignatura">Editar Asignatura</h2>
    <p class="mb-4" data-traducible="Modifica los datos de la asignatura seleccionada">
      Modifica los datos de la asignatura seleccionada
    </p>
  </div>
</div>

<!-- Formulario -->
<div class="container my-5">
  <div class="card shadow-lg border-0 rounded-4 p-4">
    <form method="POST" id="form-editar-asignatura">
      <div class="mb-3">
        <label class="form-label" data-traducible="Nombre de la Asignatura">Nombre de la Asignatura</label>
        <input type="text" name="nombre_asignatura" class="form-control" required
               value="<?= htmlspecialchars($asignatura['nombre_asignatura']) ?>">
      </div>

      <div class="mb-3">
        <label class="form-label" data-traducible="Docente">Docente</label>
        <select name="id_docente" class="form-select" required>
          <option value="" data-traducible="Seleccione un docente">Seleccione un docente</option>
          <?php foreach ($docentes as $doc): ?>
            <option value="<?= $doc['id_usuario'] ?>" <?= $doc['id_usuario'] == $asignatura['id_docente'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($doc['nombre'].' '.$doc['apellido']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-4">
        <label class="form-label" data-traducible="Grupo">Grupo</label>
        <select name="id_grupo" class="form-select" required>
          <option value="" data-traducible="Seleccione un grupo">Seleccione un grupo</option>
          <?php foreach ($grupos as $g): ?>
            <option value="<?= $g['id_grupo'] ?>" <?= $g['id_grupo'] == $asignatura['id_grupo'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($g['nombre_grupo']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="d-flex justify-content-between">
        <a href="asignaturas.php" class="btn btn-secondary" data-traducible="Cancelar">Cancelar</a>
        <button type="submit" class="btn btn-primary" data-traducible="Guardar Cambios">Guardar Cambios</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/modoClaroOscuro.js"></script>
<script src="../../js/traductor.js"></script>
<script src="../../js/editar_asignatura.js"></script>

<?php include '../tools/footer.php'; ?>
</body>
</html>

<?php $conn->close(); ?>