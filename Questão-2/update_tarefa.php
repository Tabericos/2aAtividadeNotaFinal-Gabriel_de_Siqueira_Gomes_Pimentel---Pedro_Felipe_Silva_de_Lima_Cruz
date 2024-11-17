<?php
try {
  $pdo = new PDO('sqlite:database.db');

  $id = $_GET['id'];
  $stmt = $pdo->prepare("UPDATE tasks SET concluida = 1 WHERE id = :id");
  $stmt->bindParam(':id', $id);
  if ($stmt->execute()) {
    echo "Tarefa atualizada";
  } else {
    echo "Falha ao atualizada a Tarefa";
  }

  $stmt = null;
  $pdo = null;
} catch (PDOException $e) {
  echo "Erro " . e->getMessage();
} 
?>