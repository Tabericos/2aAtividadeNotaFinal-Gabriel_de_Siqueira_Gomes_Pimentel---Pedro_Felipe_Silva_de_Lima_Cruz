<?php
try {
  $pdo = new PDO('sqlite:database.db');

  $id = $_GET['id'];
  $stmt = $pdo->prepare("DELETE FROM livros WHERE id = :id");
  $stmt->bindParam(':id', $id);
  if ($stmt->execute()) {
    echo "Livro Excluido";
  } else {
    echo "Falha ao excluir o livro";
  }

  $stmt = null;
  $pdo = null;
} catch (PDOException $e) {
  echo "Erro " . e->getMessage();
} 
?>