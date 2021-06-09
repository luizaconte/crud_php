<?php

  require_once "../topo2.php";

  session_start();
  if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
  || empty($_SESSION['id_pessoa'])) {
  echo "<p>Não existe um usuário logado no sistema.</p>";
  echo "<a href='../FrmLogin.php'>Voltar</a>";
} else {
    
?>
    <body>
        <?php
        
        try{
     
            $id_categoria = $_GET ["id"];
            
            require '../conexao.php';
            
            $sql = "select * from categoria where id_categoria=$id_categoria";

            
          foreach ($dados as $linha) {
            $id_categoria = $linha ['id_categoria'];
            $descricao=$linha['descricao_categoria'];
          }

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
          catch(Exception $e) {
            echo "Erro de SQL: " . $e->getMessage();
          }
        
        
        ?>

        <form action="alterar_categoria.php" method="POST">

            <h1>Categoria</h1>

            <input type="hidden" name="id_categoria" value="<?php  echo $id_categoria;?>" class="form-control" value="<?php  echo $id_pessoa;?>" >
               

            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" value="<?php  echo $descricao;?>" class="form-control" required autofocus><br>
            
            
            <button type="submit" class="btn btn-outline-success" style="background: #9acfea" >Alterar</button>
            <button  type="reset" class="btn btn-outline-danger" style="background: #ce8483" >Limpar</button><br><br>
            
        </form>
<?php
  }
?>
    </body>
</html>
