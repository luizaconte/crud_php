<?php
    require_once "../topo2.php";
    session_start();
    if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
        || empty($_SESSION['id_pessoa'])) {
        echo "<p>Não existe um usuário logado no sistema.</p>";
        echo "<a href='FrmLogin.php'>Voltar</a>";
    } else {
            
?>

  
    
  
    <main id="main" class="main-page" >
      <form action="inserir_tipo.php" method="POST"  style="width: 58%;margin:auto;">
        <div class="form-group col-md-12" >
          <div class="form-row" >   
            <br>
        
      
         
              <h1>Tipo</h1>
    
              <label for="descricao">Descrição:</label>
              <input type="text" name="descricao" class="form-control" required autofocus><br>
              
              
              <button type="submit" class="btn btn-outline-success" style="background: #9acfea" >Cadastrar</button>
              <button  type="reset" class="btn btn-outline-danger" style="background: #ce8483" >Limpar</button><br><br>
              
            </div>
          </div>
        </form> 
        
      </main>
    </body>
    <?php

  }

?>
</html>
