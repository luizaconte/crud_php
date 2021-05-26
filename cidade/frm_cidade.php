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
      <form action="inserir_cidade.php" method="POST"  style="width: 58%;margin:auto;">
        <div class="form-group col-md-12" >
          <div class="form-row" >   
            <br>
        
      
         
              <h1>Cidade</h1>
    
              <label for="nome_cidade ">Cidade</label>
              <input type="text" name="nome_cidade" class="form-control" required autofocus><br>

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
                                    <option value="<?php echo $linha['id_estado'] ?>"> 
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
              
    
              <button type="submit" class="btn btn-outline-success" style="background: #9acfea" >Cadastrar</button>
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
