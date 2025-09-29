<?php
  include '../php/tools/head.php';
?>

<a href="../php/usuarios/adscripta.php"><button type="button" class="btn btn-primary btn-lg">Adscripta</button></a>

<button id="btnEstudiante" type="button" class="btn btn-secondary btn-lg">Estudiante</button>

<div id="selectContainer" style="display:none; margin-top:20px;">
  <select id="opcionesEstudiante" class="form-select">
    <option value="">-- Selecciona una opción --</option>
    <option value="pagina1.php">Opción 1</option>
    <option value="pagina2.php">Opción 2</option>
    <option value="pagina3.php">Opción 3</option>
  </select>

  <button id="redirigirBtn" class="btn btn-primary mt-2">Ir</button>
</div>

<!-- Enlazar tu script JS externo -->
<script src="../js/select_estudiante.js"></script>