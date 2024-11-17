<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gerenciamento de Tarefas</title>
    <style>
      body {
        background-color: rgb(175, 255, 228);
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;

      }

      header {
        background-color: rgb(0, 0, 0);
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        box-shadow: 10px 10px 16px 0px rgba(0, 0, 0, 0.5);
        color: white;
        padding: 5px;
        font-size: 15px;
        text-align: center;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
      }

      main {
        margin-top: 100px;
        height: 120vh;
      }

      #container {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
      }

      .container-1 {
        background-color: beige;
        border: 1px solid black;
        min-width: 600px;
        max-width: 600px;
        text-align: center;

      }

      .container-1 th, td {
        padding: 5px;
        width: 300px;
        margin: auto;
        border: 1px solid black;
        background-color: rgb(240, 248, 255);
      }

      .container-1 h2 {
        background-color: rgb(83, 83, 83);
        color: white;
        margin-top: 0;
        border-bottom: 1px solid black;
        padding: 5px;
      }

      #container-2 {
        display: flex;
        flex-direction: column;
        width: 50%;
        background-color: aliceblue;
        text-align: center;
        margin: auto;
        margin-top: 50px;
        border: 1px solid black;
        margin-bottom: 200px
      }

      #container-2 h2 {
        background-color: rgb(83, 83, 83);
        margin-top: 0;
        color: white;
        padding: 5px;
        border-bottom: 1px solid black;
      }

      label, input, textarea{
        padding: 0px;
        display: flex;
        justify-content: space-around;
        width: 100%;
        box-sizing: border-box;
        color: rgb(0, 0, 0);
      }

      input, textarea{
          background-color: rgba(0,0,0,.3);
          border: 2px solid transparent;
          border-bottom-color: #bbb;
          padding: 1em;
          outline: 0;
          width: 70%;
          margin: auto;
      }

      input:invalid:focus, textarea:invalid:focus{
          border-bottom: 1px solid #ff000d;
      }

      input:valid:focus, textarea:valid:focus{
          border-bottom: 1px solid #4ef135;
      }

      input:focus, textarea:focus{
          border-bottom: 2px solid gray;
          background-color: rgb(131, 131, 131);
      }

      #btn{
          background-color: #a8a8a8;
          color: rgb(0, 0, 0);
          cursor: pointer;
          padding: .8em;
          border: 1px solid black;
          margin-bottom: 5px;
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
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
      }

    </style>
  </head>
  <body>
    <header>
      <h1>Gerenciador de Tarefas</h1>
    </header>
    <main>
      <div id="container">

        <div class="container-1">
        <h2>Tarefas a fazer:</h2>
        <table>
          <thead>
            <tr>
              <th>Tarefa</th>
              <th>Descrição</th>
              <th>Data de Vencimento</th>
              <th>Concluir/Deletar</th>
            </tr>
          </thead>
          <tbody id="data0">
          </tbody>
        </table>
      </div>
      <div class="container-1">
        <h2>Tarefas Concluídas:</h2>
        <table>
          <thead>
            <tr>
              <th>Tarefa</th>
              <th>Descrição</th>
              <th>Data de Vencimento</th>
              <th>Deletar</th>
            </tr>
          </thead>
          <tbody id="data1">
          </tbody>
        </table>
      </div>

      </div>


      <div id="container-2">
        <h2>Adicionar Tarefa:</h2>
        <form onsubmit="event.preventDefault(); add_tarefa();">
          <input type="hidden" id="id">
          <label for="tarefa">Tarefa:</label><br>
          <input type="text" id="tarefa" name="tarefa" required>
          <br><br>
          <label for="descricao">Descrição:</label><br>
          <textarea type="text" id="descricao" name="descricao" rows="5" cols="30" required></textarea>
          <br><br>
          <label for="validade">Data de Vencimento:</label><br>
          <input type="date" id="validade" name="validade" required>
          <br><br>
          <button type="submit" id="btn">Adicionar</button>
        </form>
      </div>
    </main>
      <footer>
        <p>Gabriel de Siqueira Gomes Pimentel (Matrícula: 202408193661) e Pedro Felipe Silva de Lima Cruz (Matrícula: 202403318059)</p>
      </footer>
  </body>
  <script>
    function load() {
      fetch('database.php?action=read0')
      .then(response => response.json())
      .then(data0 => {
        let table0 = document.getElementById('data0');
        table0.innerHTML =  '';
        data0.forEach(row => {
          table0.innerHTML += `
            <tr>
              <td>${row.tarefa}</td>
              <td>${row.descricao}</td>
              <td>${row.validade}</td>
              <td>
                <button onclick="update_tarefa(${row.id})">Concluir</button>
                <button onclick="delete_tarefa(${row.id})">Deletar</button>
              </td>
            </tr>
          `;
        });
      });
      fetch('database.php?action=read1')
      .then(response => response.json())
      .then(data1 => {
        let table1 = document.getElementById('data1');
        table1.innerHTML =  '';
        data1.forEach(row => {
          table1.innerHTML += `
            <tr>
              <td>${row.tarefa}</td>
              <td>${row.descricao}</td>
              <td>${row.validade}</td>
              <td>
                <button onclick="delete_tarefa(${row.id})">Deletar</button>
              </td>
            </tr>
          `;
        });
      });
    }

    function add_tarefa() {
      let tarefa = document.getElementById('tarefa').value;
      let descricao = document.getElementById('descricao').value;
      let validade = document.getElementById('validade').value;

      let formdata = new FormData();
      formdata.append('tarefa', tarefa);
      formdata.append('descricao', descricao);
      formdata.append('validade', validade);

      fetch(`add_tarefa.php`, { method: 'POST', body: formdata})
      .then(response => response.text())
      .then(data => {
        load();
        limpar();
      });
    }

    function update_tarefa(id) {

      fetch(`update_tarefa.php?id=${id}`)
      .then(response => response.text())
      .then(data => {
        load();
        limpar();
      });
    }

    function delete_tarefa(id) {

      fetch(`delete_tarefa.php?id=${id}`)
      .then(response => response.text())
      .then(data => {
        load();
        limpar();
      });
    }

    function limpar() {
      document.getElementById('tarefa').value = '';
      document.getElementById('descricao').value = '';
      document.getElementById('validade').value = '';
    }

    window.onload = limpar();
    window.onload = load();
  </script>
</html>