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
</body>