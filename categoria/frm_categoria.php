<?php
    require_once "../topo2.php";
    session_start();
    if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
    || empty($_SESSION['id_pessoa'])) {
    echo "<p>Não existe um usuário logado no sistema.</p>";
    echo "<a href='FrmLogin.php'>Voltar</a>"; 
  } else {
            
?>
      <form action="inserir_categoria.php" method="POST">

            <h1>Categoria</h1>
  
            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" class="form-control" required autofocus><br>
      </form>
      <?php 
  }
      ?>
    </body>
</html>
