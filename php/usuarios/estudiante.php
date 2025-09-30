<?php
  include '../tools/head.php';
?>

<?php
  include '../tools/header_estudiante.php';
?>

<?php
// estudiante.php

if (isset($_GET['opcion'])) {
    $opcion = $_GET['opcion'];

    // lista de grupos válidos para evitar includes peligrosos
    $gruposValidos = [
        "1MC" => "calendarios/1MC.php",
        "1MD" => "calendarios/1MD.php",
        "2MA" => "calendarios/2MA.php",
        "2MB" => "calendarios/2MB.php",
        "2MD" => "calendarios/2MD.php",
        "3MA" => "calendarios/3MA.php",
        "3MB" => "calendarios/3MB.php",
        "3MD" => "calendarios/3MD.php",
        "3BA" => "calendarios/3BA.php"
    ];

    if (array_key_exists($opcion, $gruposValidos)) {
        include $gruposValidos[$opcion];
    } else {
        echo "<p>No existe calendario para esta opción.</p>";
    }
} else {
    echo "<p>No seleccionaste ningún grupo.</p>";
}
?>