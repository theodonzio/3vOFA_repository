<?php
// index.php
$servername = "localhost";
$username = "OFA";
$password = "ofametamate";
$dbname = "db_OFA";

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
