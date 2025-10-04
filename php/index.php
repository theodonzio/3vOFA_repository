<?php
  include '../php/tools/head.php';
?>

<link rel="stylesheet" href="../css/style.css">

<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
    <div class="logo">
      <img src="../img/ofalogos/fulltextnegativo.png" id="logo-barra">
      <a href="#" id="boton-tema">Tema</a>
    </div>
    </nav>
</header>

<body class="body_index">
<main class="selector">

    <div class="bienvenida">
    <h2 class="font-weight-bold">¿Quién eres?</h2>
    <h5>Ingresa a tu perfil</h5>
    </div>

<?php
  include '../php/tools/ventanaModales.php';
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/loginModal.js"></script>
<script src="../js/modoClaroOscuro.js"></script>

</body>