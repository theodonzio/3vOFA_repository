<?php
// Obtener id_grupo de la URL o sesión
$id_grupo_header = isset($_GET['id_grupo']) ? intval($_GET['id_grupo']) : (isset($id_grupo_actual) ? $id_grupo_actual : 0);
?>

<link rel="stylesheet" href="../../css/style.css">

<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid d-flex align-items-center" id="header_nav">
      
      <div class="logo me-auto">
        <img src="../../img/ofalogos/fulltextnegativo.png" id="logo-barra" alt="Logo OFA">
      </div>

      <!-- Botón toggler -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
              data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" 
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" 
               data-bs-toggle="dropdown" aria-expanded="false" data-traducible="General">
              General
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li class="AlinearBotones">
                <img src="../../img/icons/timetable_icon.png" class="icono" alt="Horarios">
                <a class="dropdown-item" href="../usuarios/estudiante.php?id_grupo=<?= $id_grupo_header ?>" data-traducible="Horarios">
                  Horarios
                </a>
              </li>
              <li class="AlinearBotones">
                <img src="../../img/icons/teach_icon.png" class="icono" alt="Docentes">
                <a class="dropdown-item" href="../usuarios/docentesestudiantes.php?id_grupo=<?= $id_grupo_header ?>" data-traducible="Docentes">
                  Docentes
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" 
               data-bs-toggle="dropdown" aria-expanded="false" data-traducible="Cuenta">
              Cuenta
            </a>
            <ul class="dropdown-menu dropdown-menu-end" id="cerrar_sesion">
              <li>
                <a class="dropdown-item" href="../login/logout.php" id="exit" data-traducible="Salir">
                  <i class="bi bi-box-arrow-right me-2"></i>Salir
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <div class="dropdown theme">
              <img src="../../img/icons/config_icon(black).png" 
                   class="theme_icon_mode dropdown-toggle" 
                   id="boton-tema"
                   data-bs-toggle="dropdown" 
                   aria-expanded="false"
                   alt="Configuración">
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

<script src="../../js/header-estudiante-leng.js"></script>