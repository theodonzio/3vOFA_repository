<?php
// index.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_ofa";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("❌ Conexión fallida: " . $conn->connect_error);
}
echo "✅ Conectado correctamente a la base de datos '$dbname'";
return $conn;
//$conn->close();
?>