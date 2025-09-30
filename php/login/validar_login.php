<?php
session_start();
require_once __DIR__ . '/conexion_bd.php';  // ✅ ruta corregida

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn->set_charset('utf8mb4');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { 
  header('Location: ../ventanamodales.php'); 
  exit; 
}

$usuarioRaw = trim($_POST['usuario'] ?? '');
$passInput  = trim($_POST['contrasena'] ?? '');

if ($usuarioRaw === '' || $passInput === '') {
  header('Location: ../ventanamodales.php?error=Complete usuario y contraseña'); 
  exit;
}

// Buscar por email o por cédula
if (filter_var($usuarioRaw, FILTER_VALIDATE_EMAIL)) {
  $sql  = "SELECT id_usuario, nombre, apellido, contrasena, id_rol FROM Usuario WHERE email=? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $usuarioRaw);
} else {
  $cedulaNorm = preg_replace('/\D+/', '', $usuarioRaw);
  $sql  = "SELECT id_usuario, nombre, apellido, contrasena, id_rol FROM Usuario WHERE cedula=? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $cedulaNorm);
}

$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
  header('Location: ../ventanamodales.php?error=Usuario no encontrado'); 
  exit;
}

$u    = $res->fetch_assoc();
$hash = $u['contrasena'];

$ok = (preg_match('/^\$2y\$/', $hash) || strlen($hash) >= 50)
        ? password_verify($passInput, $hash)
        : hash_equals($hash, $passInput);

if ($ok && !(preg_match('/^\$2y\$/', $hash) || strlen($hash) >= 50)) {
  $new = password_hash($passInput, PASSWORD_DEFAULT);
  $up  = $conn->prepare("UPDATE Usuario SET contrasena=? WHERE id_usuario=?");
  $up->bind_param('si', $new, $u['id_usuario']);
  $up->execute();
}

if (!$ok) { 
  header('Location: ../ventanamodales.php?error=Contraseña incorrecta'); 
  exit; 
}

session_regenerate_id(true);
$_SESSION['id_usuario'] = (int)$u['id_usuario'];
$_SESSION['nombre']     = $u['nombre'];
$_SESSION['apellido']   = $u['apellido'];
$_SESSION['id_rol']     = isset($u['id_rol']) ? (int)$u['id_rol'] : null;

header('Location: ../index.php'); 
exit;
?>
