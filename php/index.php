<?php
  include '../php/tools/head.php';
?>
    <link rel="stylesheet" href="../css/style.css">


<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
    <div class="logo" style="display: flex; justify-content: center; align-items: center; width: 100%;">
      <img src="../img/ofalogos/fulltextnegativo.png" id="logo-barra">
    </div>
</header>

<body class="body_index">
<main class="selector">

    <div class="bienvenida">
    <h2>Bienvenid@!</h2>
    <h5>Selecciona una opción</h5>
    </div>

    <div class="botones">
    <a href="../php/usuarios/adscripta.php"><button type="button" class="btn btn-primary btn-lg"><img src="../img/icons/faceid_icon.png" class="indexlogo">Adscript@</button></a>
    <a href=""><button id="btnEstudiante" type="button" class="btn btn-secondary btn-lg"><img src="../img/icons/student_icon.png" class="indexlogo">Estudiante</button></a>
    </div>
</main>

<div id="selectContainer" style="display:none; margin-top:20px;">
<select id="opcionesEstudiante" class="form-select">
    <option value="pagina1.php">Opción 1</option>
    <option value="pagina2.php">Opción 2</option>
    <option value="pagina3.php">Opción 3</option>
</select>
    <button id="redirigirBtn" class="btn btn-primary mt-2">Ir</button>
</div>

</body>

<!-- Enlazar tu script JS externo -->
<script src="../js/select_estudiante.js"></script>