<link rel="stylesheet" href="../../css/style.css">

<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
      <div class="logo">
      <img src="../../img/ofalogos/fulltextnegativo.png" id="logo-barra" alt="Logo">
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">General</a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#"><img src="../../img/icons/timetable_icon.png" class="icono" alt="Horarios">Horarios</a></li>
            <li><a class="dropdown-item" href="#"><img src="../../img/icons/space_icon.png" class="icono" alt="Grupos">Grupos</a></li>
            <li><a class="dropdown-item" href="#"><img src="../../img/icons/bookmark_icon.png" class="icono" alt="Reservar">Reservar</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cuenta</a>
          <ul class="dropdown-menu dropdown-menu-end" id="cerrar_sesion">
            <li><a class="dropdown-item" href="../index.php" id="exit"><img src="../../img/icons/exit_icon.png" class="icono invert_color" alt="Salir">Salir</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <div class="dropdown theme">
          <img 
            src="../../img/icons/config_icon(black).png"
            class="theme_icon_mode dropdown-toggle"
            id="boton-tema"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            alt="Configuración"
          >

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
        </li>
      </ul>
    </div>
  </div>
</nav>
</header>

<script src="../../js/activdorHover.js"></script>