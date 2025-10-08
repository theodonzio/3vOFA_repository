<?php
include '../conexion.php';

$data = json_decode(file_get_contents("php://input"), true);
$id_grupo = $data['id_grupo'];
$horarios = $data['horarios'];

if (!$id_grupo || !$horarios) {
  echo json_encode(["titulo" => "Error", "mensaje" => "Datos inválidos", "icono" => "error"]);
  exit;
}

foreach ($horarios as $item) {
  $sql = "INSERT INTO grupo_horario (id_grupo, id_horario, dia_semana, contenido)
          VALUES (?, ?, ?, ?)
          ON DUPLICATE KEY UPDATE contenido = VALUES(contenido)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iiis", $id_grupo, $item['id_horario'], $item['dia_semana'], $item['contenido']);
  $stmt->execute();
}

echo json_encode(["titulo" => "Éxito", "mensaje" => "Horarios guardados correctamente", "icono" => "success"]);
