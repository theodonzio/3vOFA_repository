<?php
  include '../php/tools/head.php';

if (isset($_GET['login'])): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  <?php if ($_GET['login'] === 'success'): ?>
    const rol = "<?php echo $_GET['rol'] ?? ''; ?>";

    Swal.fire({
      icon: 'success',
      title: 'Inicio de sesión correcto',
      text: 'Bienvenido/a al sistema.',
      timer: 1800,
      showConfirmButton: false
    }).then(() => {
      // Redirige según el rol
      if (rol === '1') {
        window.location.href = 'usuarios/adscripta.php';
      } else if (rol === '2') {
        window.location.href = 'usuarios/docente.php';
      } else {
        window.location.href = 'usuarios/estudiante.php';
      }
    });
  <?php elseif ($_GET['login'] === 'error_pass'): ?>
    Swal.fire({
      icon: 'error',
      title: 'Contraseña incorrecta',
      text: 'Verifica tu contraseña e inténtalo de nuevo.',
      confirmButtonText: 'Intentar de nuevo'
    });
  <?php elseif ($_GET['login'] === 'error_user'): ?>
    Swal.fire({
      icon: 'warning',
      title: 'Usuario no encontrado',
      text: 'No existe una cuenta con ese correo o cédula.',
      confirmButtonText: 'OK'
    });
  <?php endif; ?>
});
</script>
<?php endif; ?>

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
            <li><a class="dropdown-item" href="#" id="tema-claro" data-traducible="Claro"><img  class="icono">Claro</a></li>
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
      <h2 class="font-weight-bold" id="titulo" data-traducible="¿Quién eres?">¿Quién eres?</h2>
      <h5 id="subtitulo" data-traducible="Ingresa a tu perfil">Ingresa a tu perfil</h5>
    </div>

<?php
  include '../php/tools/ventanaModales.php';
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/traductor.js"></script>
<script src="../js/loginModal.js"></script>
<script src="../js/modoClaroOscuro.js"></script>
</body>
