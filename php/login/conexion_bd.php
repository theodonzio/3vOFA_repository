<?php
// conexion_bd.php
$servername = "127.0.0.1"; // mejor usar 127.0.0.1 para evitar problemas de socket
$username = "root";
$password = "";
$dbname = "db_ofa";


// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("❌ Conexión fallida: " . $conn->connect_error);
}
// echo "✅ Conectado correctamente a la base de datos '$dbname'"; // quitar en producción
?>
