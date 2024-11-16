<?php
   try {
     $pdo = new PDO('sqlite:database.db');

     $titulo = $_POST['titulo'];
     $autor = $_POST['autor'];
     $ano = $_POST['ano'];
     $stmt = $pdo->prepare("INSERT INTO livros (titulo, autor, ano) VALUES (:titulo, :autor, :ano)");
     $stmt->bindParam(':titulo', $titulo);
     $stmt->bindParam(':autor', $autor);
     $stmt->bindParam(':ano', $ano);
     if ($stmt->execute()) {
       echo "Livro Adicionado";
     } else {
       echo "Falha ao adicionar o livro";
     }

     $stmt = null;
     $pdo = null;
   } catch (PDOException $e) {
     echo "Erro " . e->getMessage();
   } 
?>