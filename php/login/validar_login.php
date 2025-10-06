<?php
session_start();
require_once __DIR__ . '/conexion_bd.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ../tools/ventanaModales.php?error=Contraseña incorrecta');
  exit;
}

$usuarioRaw = trim($_POST['usuario'] ?? '');
$passInput  = trim($_POST['contrasena'] ?? '');
$rol        = trim($_POST['Rol'] ?? '');

if ($usuarioRaw === '' || $passInput === '') {
  header('Location: ../index.php?error=Complete usuario y contraseña');
  exit;
}

// Buscar por email o cédula (incluyendo el rol)
if (filter_var($usuarioRaw, FILTER_VALIDATE_EMAIL)) {
  $sql = "SELECT id_usuario, nombre, apellido, contrasena, id_rol FROM Usuario WHERE email=? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $usuarioRaw);
} else {
  $cedulaNorm = preg_replace('/\D+/', '', $usuarioRaw);
  $sql = "SELECT id_usuario, nombre, apellido, contrasena, id_rol FROM Usuario WHERE cedula=? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $cedulaNorm);
}

$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
  header('Location: ../index.php?error=Usuario no encontrado');
  exit;
}

$u = $res->fetch_assoc();
$hash = $u['contrasena'];

// Verificar contraseña
$ok = (preg_match('/^\$2y\$/', $hash) || strlen($hash) >= 50)
        ? password_verify($passInput, $hash)
        : hash_equals($hash, $passInput);

// Si estaba sin encriptar, se actualiza
if ($ok && !(preg_match('/^\$2y\$/', $hash) || strlen($hash) >= 50)) {
  $new = password_hash($passInput, PASSWORD_DEFAULT);
  $up  = $conn->prepare("UPDATE Usuario SET contrasena=? WHERE id_usuario=?");
  $up->bind_param('si', $new, $u['id_usuario']);
  $up->execute();
}

if (!$ok) {
  header('Location: ../index.php?error=Contraseña incorrecta');
  exit;
}

// Iniciar sesión
session_regenerate_id(true);
$_SESSION['id_usuario'] = (int)$u['id_usuario'];
$_SESSION['nombre']     = $u['nombre'];
$_SESSION['apellido']   = $u['apellido'];
$_SESSION['id_rol']     = (int)$u['id_rol'];
$_SESSION['Rol']        = $rol;

// Redirigir según el rol
$id_rol = (int)$u['id_rol'];

switch ($id_rol) {
  case 1:
    header('Location: ../usuarios/adscripta.php');
    break;
  case 2:
    header('Location: ../usuarios/docente.php');
    break;
  case 3:
    header('Location: ../usuarios/estudiante.php');
    break;
  default:
    header('Location: ../index.php?error=Rol no válido');
    break;
}

exit;
?>