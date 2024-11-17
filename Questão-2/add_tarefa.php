<?php
   try {
     $pdo = new PDO('sqlite:database.db');

     $tarefa = $_POST['tarefa'];
     $descricao = $_POST['descricao'];
     $validade = $_POST['validade'];
     $stmt = $pdo->prepare("INSERT INTO tasks (tarefa, descricao, validade) VALUES (:tarefa, :descricao, :validade)");
     $stmt->bindParam(':tarefa', $tarefa);
     $stmt->bindParam(':descricao', $descricao);
     $stmt->bindParam(':validade', $validade);
     if ($stmt->execute()) {
       echo "Tarefa Adicionada";
     } else {
       echo "Falha ao adicionar a Tarefa";
     }

     $stmt = null;
     $pdo = null;
   } catch (PDOException $e) {
     echo "Erro " . e->getMessage();
   } 
?>