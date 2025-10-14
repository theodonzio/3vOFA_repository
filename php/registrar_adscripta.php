<?php
  include '../php/tools/head.php';
?>

<link rel="stylesheet" href="../css/style.css">

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

<body class="body_index">
<main class="selector">
  <div class="bienvenida">
    <h2 class="font-weight-bold">Registrar Adscripta</h2>
    <h5>Completa los datos para crear una cuenta de adscripta</h5>
  </div>

  <form action="procesar_registro_adscripta.php" method="POST" class="form_login" style="max-width: 400px;">
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>

    <div class="mb-3">
      <label for="apellido" class="form-label">Apellido</label>
      <input type="text" class="form-control" id="apellido" name="apellido" required>
    </div>

    <div class="mb-3">
      <label for="cedula" class="form-label">Cédula</label>
      <input type="text" class="form-control" id="cedula" name="cedula" maxlength="8" pattern="[0-9]{8}" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Correo electrónico</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
      <label for="contrasena" class="form-label">Contraseña</label>
      <input type="password" class="form-control" id="contrasena" name="contrasena"
             pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$"
             title="Debe contener al menos una letra, un número y mínimo 6 caracteres" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Registrar</button>
  </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/traductor.js"></script>
<script src="../js/modoClaroOscuro.js"></script>

<?php if (isset($_GET['registro'])): ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const isDarkMode = document.body.classList.contains('oscuro');
  const bg = isDarkMode ? '#2c2c2c' : '#fff';
  const color = isDarkMode ? '#f5f5f5' : '#212529';

  <?php if ($_GET['registro'] === 'success'): ?>
    Swal.fire({
      icon: 'success',
      title: 'Registro exitoso',
      text: 'La adscripta fue registrada correctamente.',
      background: bg,
      color: color,
      confirmButtonText: 'OK'
    }).then(() => window.location.href = 'index.php');
  <?php elseif ($_GET['registro'] === 'duplicado'): ?>
    Swal.fire({
      icon: 'warning',
      title: 'Ya existe una cuenta con esa cédula o correo.',
      text: 'Verifica los datos e intenta nuevamente.',
      background: bg,
      color: color,
      confirmButtonText: 'OK'
    });
  <?php elseif ($_GET['registro'] === 'error'): ?>
    Swal.fire({
      icon: 'error',
      title: 'Error en el registro',
      text: 'Ocurrió un problema al registrar. Intenta nuevamente.',
      background: bg,
      color: color,
      confirmButtonText: 'OK'
    });
  <?php endif; ?>
});
</script>
<?php endif; ?>
</body>