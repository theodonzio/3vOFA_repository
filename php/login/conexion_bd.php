<?php
$servername = "localhost"; 
$username = "root";       // o "OFA" si ya creaste ese usuario
$password = "";           // o "ofametamate" si usas ese password
$dbname = "db_ofa";       // el nombre exacto de la BD

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("❌ Error al conectar con la base de datos: " . $conn->connect_error);
}

// Si quieres probar la conexión, puedes descomentar esto:
// echo "✅ Conectado correctamente a '$dbname'";

$conn->set_charset("utf8mb4");
?>
