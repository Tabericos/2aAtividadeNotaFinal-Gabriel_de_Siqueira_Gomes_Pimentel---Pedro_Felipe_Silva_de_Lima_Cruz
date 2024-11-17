<?php
try {
  $pdo = new PDO('sqlite:database.db');
  $sql = "CREATE TABLE IF NOT EXISTS tasks (id INTEGER PRIMARY KEY AUTOINCREMENT, tarefa TEXT NOT NULL UNIQUE, descricao TEXT NOT NULL, validade TEXT NOT NULL, concluida INTEGER NOT NULL DEFAULT 0)";
  $pdo->exec($sql);

  $action = isset($_GET['action']) ? $_GET['action'] : '';
  
  if ($action == 'read0') {
    $stmt = $pdo->query("SELECT * FROM tasks WHERE concluida = 0");
    $result = $stmt->fetchALL(PDO:: FETCH_ASSOC);
    echo json_encode($result);
  }
  if ($action == 'read1') {
    $stmt = $pdo->query("SELECT * FROM tasks WHERE concluida = 1");
    $result = $stmt->fetchALL(PDO:: FETCH_ASSOC);
    echo json_encode($result);
  }
  $stmt = null;
  $pdo = null;
} catch (PDOException $e) {
  echo "Erro " . e->getMessage();
} 
?>