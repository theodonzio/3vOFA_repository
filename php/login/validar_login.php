<?php
session_start();
require_once __DIR__ . '/../conexion_bd.php'; // $conn = new mysqli(...)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn->set_charset('utf8mb4');

$DEBUG = true;  // ponlo en false cuando termine la prueba
function dbg($m){ global $DEBUG; if($DEBUG) error_log("[login] $m"); }

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: login.php'); exit; }

$usuarioRaw = trim($_POST['usuario'] ?? '');
$passInput  = trim($_POST['contrasena'] ?? '');

if ($usuarioRaw === '' || $passInput === '') {
  header('Location: login.php?error=Complete usuario y contraseña'); exit;
}

$dbname = $conn->query("SELECT DATABASE()")->fetch_row()[0];
dbg("DB=$dbname; user_raw='$usuarioRaw'");

// Si parece email, busco por email; si no, asumo cédula y la normalizo (solo dígitos)
if (filter_var($usuarioRaw, FILTER_VALIDATE_EMAIL)) {
  $sql  = "SELECT id_usuario, nombre, apellido, contrasena, id_rol FROM Usuario WHERE email=? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $usuarioRaw);
  dbg("lookup=email");
} else {
  $cedulaNorm = preg_replace('/\D+/', '', $usuarioRaw); // "1.234.567-8" -> "12345678"
  $sql  = "SELECT id_usuario, nombre, apellido, contrasena, id_rol FROM Usuario WHERE cedula=? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $cedulaNorm);
  dbg("lookup=cedula norm='$cedulaNorm'");
}

$stmt->execute();
$res = $stmt->get_result();
dbg("rows=".$res->num_rows);

if ($res->num_rows === 0) {
  header('Location: login.php?error=Usuario no encontrado'); exit;
}

$u    = $res->fetch_assoc();
$hash = $u['contrasena'];

// A) hash (bcrypt u otro)
$ok = (preg_match('/^\$2y\$/', $hash) || strlen($hash) >= 50)
        ? password_verify($passInput, $hash)
        : hash_equals($hash, $passInput); // B) texto plano

// Migración opcional a hash si entró por texto plano
if ($ok && !(preg_match('/^\$2y\$/', $hash) || strlen($hash) >= 50)) {
  $new = password_hash($passInput, PASSWORD_DEFAULT);
  $up  = $conn->prepare("UPDATE Usuario SET contrasena=? WHERE id_usuario=?");
  $up->bind_param('si', $new, $u['id_usuario']);
  $up->execute();
  dbg("migrated to hash user_id=".$u['id_usuario']);
}

if (!$ok) { header('Location: login.php?error=Contraseña incorrecta'); exit; }

session_regenerate_id(true);
$_SESSION['id_usuario'] = (int)$u['id_usuario'];
$_SESSION['nombre']     = $u['nombre'];
$_SESSION['apellido']   = $u['apellido'];
$_SESSION['id_rol']     = isset($u['id_rol']) ? (int)$u['id_rol'] : null;

header('Location: ../index.php'); exit;