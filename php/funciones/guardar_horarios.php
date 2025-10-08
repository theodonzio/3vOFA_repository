<?php
include '../login/conexion_bd.php';

$datos = json_decode(file_get_contents("php://input"), true);

if (!$datos) {
  echo "❌ No se recibieron datos.";
  exit;
}

foreach ($datos as $fila) {
  $id = intval($fila['id']);
  $inicio = $conn->real_escape_string($fila['inicio']);
  $fin = $conn->real_escape_string($fila['fin']);

  $sql = "UPDATE horarios SET inicio='$inicio', fin='$fin' WHERE id=$id";
  $conn->query($sql);
}

echo "✅ Horarios actualizados correctamente.";
$conn->close();
?>
