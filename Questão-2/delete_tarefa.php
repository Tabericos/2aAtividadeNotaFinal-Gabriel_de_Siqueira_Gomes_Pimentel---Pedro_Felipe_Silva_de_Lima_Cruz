<?php
try {
  $pdo = new PDO('sqlite:database.db');

  $id = $_GET['id'];
  $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id");
  $stmt->bindParam(':id', $id);
  if ($stmt->execute()) {
    echo "Tarefa Excluida";
  } else {
    echo "Falha ao excluir a Tarefa";
  }

  $stmt = null;
  $pdo = null;
} catch (PDOException $e) {
  echo "Erro " . e->getMessage();
} 
?>