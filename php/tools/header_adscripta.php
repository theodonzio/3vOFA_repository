<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
      <div class="logo">
      <img src="../../img/ofalogos/fulltextnegativo.png" id="logo-barra">
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">General</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#"><img src="../../img/icons/timetable_icon.png" class="icono">Horarios</a></li>
            <li><a class="dropdown-item" href="#"><img src="../../img/icons/space_icon.png" class="icono">Espacios</a></li>
            <li><a class="dropdown-item" href="#"><img src="../../img/icons/teach_icon.png" class="icono">Docentes</a></li>
            <li><a class="dropdown-item" href="#"><img src="../../img/icons/class_icon.png" class="icono">Grupos</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Herramientas</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Tema</a></li>
            <li><a class="dropdown-item" href="#">Lenguaje</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cuenta</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../index.php">Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
</header>

<!-- Bootstrap Bundle JS (dropdown y tooltip) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous" ></script>
<!-- Inicialización de tooltips -->
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
</script>
