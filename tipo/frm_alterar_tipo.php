<?php
    require_once "../topo2.php";

    session_start();
    if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
        || empty($_SESSION['id_pessoa'])) {
        echo "<p>Não existe um usuário logado no sistema.</p>";
        echo "<a href='FrmLogin.php'>Voltar</a>";
    } else {

?>
    <body>
        
        <?php

        try{
        
          require_once '../conexao.php';
          
          $id_tipo=$_GET['id_tipo'];
          
          $sql="Select * From tipo where id_tipo=$id_tipo";
        
          $resultado = $conn->query($sql);
          $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

          foreach ($dados as $linha) {
  
            $descricao= $linha['descricao_tipo'];

           
          }
        }
        catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
        catch(Exception $e) {
          echo "Erro de SQL: " . $e->getMessage();
        }
         
        ?>
      <header id="header" class="header-fixed">
        <div class="container">

          <div id="logo" class="pull-left">
            <a href="../index.php#intro" class="scrollto"><img src="../img/logo.png" alt="" title=""></a>
          </div>

          <nav id="nav-menu-container">
           
          </nav><!-- #nav-menu-container -->
        </div>
      </header>  
         
    <main id="main" class="main-page" >
   
        <form action="alterar_tipo.php" method="POST" enctype="multipart/form-data" style="width: 58%;margin:auto;">
          <div class="form-group col-md-12" style="background:#fff" >
            <div class="form-row" > 
                    
              <h1><a>Tipo</a></h1>
                      
              <input type="hidden" name="id_tipo" class="form-control" value="<?php  echo $id_tipo;?>" >
                      
              <label for="descricao">Descrição:</label>
              <input type="text" name="descricao" class="form-control" required autofocus  value="<?php  echo "$descricao";?>"><br>
              
              <br>

            <button type="submit" name="entrar" class="btn btn-outline-success" style="background:#cccccc" >Alterar</button>
            <button  type="reset" class="btn btn-outline-danger" style="background: #ff6666" >Limpar</button><br><br>
            
                </div>
            </div>
        </form> 
      
    </main>

</body>
<?php

  }

?>
</html>
