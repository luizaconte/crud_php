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
     
            $id_cidade = $_GET ["id"];
            
            require '../conexao.php';
            
            $sql = "select * from cidade where id_cidade=$id_cidade";

            $resultado = $conn->query($sql);
            $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
            
          foreach ($dados as $linha) {
            $id_cidade = $linha ['id_cidade'];
            $nome_cidade=$linha['nome_cidade'];
            $cod_estado=$linha['cod_estado'];
          } 

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
          catch(Exception $e) {
            echo "Erro de SQL: " . $e->getMessage();
          }
        
        
        ?>
        <main id="main" class="main-page" >
   

        <form action="alterar_cidade.php" method="POST">
        <div class="form-group col-md-12" style="background:#fff" >
            <div class="form-row" > 
                    
              
              <h1>Cidade</h1>

              <input type="hidden" name="id_cidade" value="<?php  echo $id_cidade;?>" class="form-control" >
              <label for="nome_cidade ">Cidade</label>
              <input type="text" name="nome_cidade" class="form-control" value="<?php  echo $nome_cidade;?>"  required autofocus><br>

              <label for="cod_estado">Estado</label>
              
              <select name="cod_estado" class="form-control">
                          
                  <option value="selecione" selected>Selecione uma estado</option> 
                      <?php 

                          try{
                                  
                              require_once '../conexao.php';
                              
                              $sql="select * from estado";

                              $resultado = $conn->query($sql);
                              $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
    
                              foreach ($dados as $linha) {    
                                  ?> 
                                    <option value="<?php echo $linha['id_estado'] ?>"
                                    <?php if($cod_estado == $linha['id_estado']) echo 'selected' ?>  > 
  
                                        <?php echo utf8_encode ($linha['sigla_estado'] );?> 
                                    </option> 
                                  <?php 
                                
                                } 
                            

                          }catch(PDOException $e) {
                              echo "Connection failed: " . $e->getMessage();
                          }catch(Exception $e) {
                              echo "Erro de SQL: " . $e->getMessage();
                          }
                              
                            
                          ?>
                    </select>
              
              <br>
              
    
            
              <button type="submit" class="btn btn-outline-success" style="background: #9acfea" >Alterar</button>
              <button  type="reset" class="btn btn-outline-danger" style="background: #ce8483" >Limpar</button><br><br>
              
              </div>
            </div>
        </form> 
      
    </main>
<?php
  }
?>
    </body>
</html>
