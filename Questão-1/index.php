<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco de Dados Livraria</title>
    <style>
      body {
        background-image: url(https://i0.wp.com/assets.b9.com.br/wp-content/uploads/2015/09/japaogif3.gif?fit=500%2C708&ssl=1);
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        min-width: 100%;

      }

      header {
        background: #000000;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        box-shadow: 10px 10px 16px 0px rgba(0, 0, 0, 0.5);
        color: white;
        padding: 8px;
        font-size: 10px;
        text-align: center;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
      }

      main {
        margin-top: 100px;
        height: 120vh;
      }

      #container {
        display: flex;
        flex-direction:column;
        width: 100%;
        align-items: center;
        justify-content: center;
      }

      #container h2 {
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        margin-bottom: 10px;
      }

      #tabela {
        background-color: white;
        padding: 10px;
        border-collapse: collapse;
        border: 2px solid black;
      }

      #tabela th, td {
        padding: 18px;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        border: 1px solid black;
      }

      #container2 {
        display: flex;
        flex-direction: column;
        padding: 0px;
        text-align: left;
        width: 25%;
        text-align: center;
      }

      #container2 label {
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
      }

      #container2 h2 {
          font-size: 20px;
          font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
      }

      #container3 {
        display: flex;
        flex-direction: column;
        padding: 0px;
        text-align: left;
        width: 25%;
        text-align: center;
      }

      #container3 label {
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
      }

      #container3 h2 {
          font-size: 20px;
          font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
      }

      #container-geral {
        display: flex;
        width: 40%;
        margin: auto;
        flex-direction: row;
        align-items: center;
        justify-content: space-around;
        margin-top: 35px;
        padding: 10px;
        border: 1px solid black;
        background-color: rgb(236, 236, 236);
      }

      input {
        padding: 5px;
      }

      footer {
        text-align: center;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 50px;
        color: white;
        background-color: black;
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Livraria</h1>
    </header>
    <main>
      <div id="container">
        <h2>Livros:</h2>
      <table id='tabela'>
        <thead>
          <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Ano de publicação</th>
          </tr>
        </thead>
        <tbody id="data">
        </tbody>
      </table>
      </div>
      <div id="container-geral">
        <div id="container2">
        <h2>Adicionar Livro</h2>
        <form onsubmit="event.preventDefault(); adicionar();">
          <input type="hidden" id="id">
          <label for="titulo">Título do Livro:</label>
          <input type="text" id="titulo" name="titulo" required>
          <br><br>
          <label for="autor">Nome do Autor:</label>
          <input type="text" id="autor" name="autor" required>
          <br><br>
          <label for="ano">Ano de publicação:</label>
          <input type="number" id="ano" name="ano" max=2024 min=1000 required>
          <br><br>
          <button type="submit">Enviar</button>
        </form>
        </div>
        <div id="container3">
          <h2>Excluir Livro</h2>
          <form onsubmit="event.preventDefault(); deletar();">
            <label for="excluir">ID do Livro:</label>
            <input type="number" id="excluir" name="excluir" required>
            <br><br>
            <button type="submit">Excluir</button>
          </form>
        </div>
      </div>

    </main>
      <footer>
        <p>Gabriel de Siqueira Gomes Pimentel (Matrícula: 202408193661) e Pedro Felipe Silva de Lima Cruz (Matrícula: 202403318059)</p>
      </footer>
  </body>
  <script>
    function carregar() {
      fetch('database.php')
      .then(response => response.json())
      .then(data => {
        let table = document.getElementById('data');
        table.innerHTML =  '';
        data.forEach(row => {
          table.innerHTML += `
            <tr>
              <td>${row.id}</td>
              <td>${row.titulo}</td>
              <td>${row.autor}</td>
              <td>${row.ano}</td>
            </tr>
          `;
        });
      });
    }

    function adicionar() {
      let id = document.getElementById('id').value;
      let titulo = document.getElementById('titulo').value;
      let autor = document.getElementById('autor').value;
      let ano = document.getElementById('ano').value;

      let formdata = new FormData();
      formdata.append('id', id);
      formdata.append('titulo', titulo);
      formdata.append('autor', autor);
      formdata.append('ano', ano);

      fetch(`add_book.php`, { method: 'POST', body: formdata})
      .then(response => response.text())
      .then(data => {
        carregar();
        limpar();
      });
    }

    function deletar() {
      let id = document.getElementById('excluir').value;

      fetch(`delete_book.php?id=${id}`)
      .then(response => response.text())
      .then(data => {
        carregar();
        limpar();
      });
    }

    function limpar() {
      document.getElementById('id').value = '';
      document.getElementById('titulo').value = '';
      document.getElementById('autor').value = '';
      document.getElementById('ano').value = '';
      document.getElementById('excluir').value = '';
    }

    window.onload = limpar();
    window.onload = carregar();
  </script>
</html>