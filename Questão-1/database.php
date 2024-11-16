<?php
try {
  $pdo = new PDO('sqlite:database.db');
  $sql = "CREATE TABLE IF NOT EXISTS livros (id INTEGER PRIMARY KEY AUTOINCREMENT, titulo TEXT NOT NULL, autor TEXT NOT NULL, ano INTEGER NOT NULL)";
  $pdo->exec($sql);
  
  $stmt = $pdo->query("SELECT * FROM livros");
  $result = $stmt->fetchALL(PDO:: FETCH_ASSOC);
  echo json_encode($result);

  $stmt = null;
  $pdo = null;
} catch (PDOException $e) {
  echo "Erro " . e->getMessage();
} 
?>