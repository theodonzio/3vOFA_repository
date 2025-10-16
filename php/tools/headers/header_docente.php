<link rel="stylesheet" href="../../css/style.css">

<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid d-flex align-items-center" id="header_nav">
      
      <!-- Logo a la izquierda -->
      <div class="logo me-auto">
          <img src="../../img/ofalogos/fulltextnegativo.png" id="logo-barra">
      </div>

      <!-- Botón toggler (para mobile) -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-traducible="General">General</a>
            <ul class="dropdown-menu dropdown-menu-end">
            <li class="AlinearBotones"><img src="../../img/icons/timetable_icon.png" class="icono">
                <a class="dropdown-item" href="#GestionHorarios" data-traducible="Horarios">Horarios</a></li>              
            <li class="AlinearBotones"><img src="../../img/icons/abc_icon.png" class="icono">
                <a class="dropdown-item" href="#HeroGrupos" data-traducible="Grupos">Grupos</a></li>             
            <li class="AlinearBotones"><img src="../../img/icons/bookmark_icon.png" class="icono">
              <a class="dropdown-item" href="#tabla_reservas_docente" data-traducible="Reservas">Reservas</a></li>
            </ul>
          </li>         

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-traducible="Cuenta">Cuenta</a>
            <ul class="dropdown-menu dropdown-menu-end" id="cerrar_sesion">
              <li><a id="exit" class="dropdown-item" href="../index.php" data-traducible="Salir">Salir</a></li>
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

<script>
document.addEventListener("DOMContentLoaded", () => {
  const idiomaGuardado = localStorage.getItem("idioma") || "es";

  const esItem = document.getElementById("lenguaje-es");
  const enItem = document.getElementById("lenguaje-en");

  if (idiomaGuardado === "es") {
    esItem.classList.add("active");
    enItem.classList.remove("active");
  } else {
    enItem.classList.add("active");
    esItem.classList.remove("active");
  }

  esItem.addEventListener("click", () => {
    esItem.classList.add("active");
    enItem.classList.remove("active");
  });
  enItem.addEventListener("click", () => {
    enItem.classList.add("active");
    esItem.classList.remove("active");
  });
});
</script>
