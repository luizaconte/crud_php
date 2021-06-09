<?php
    require_once "../topo2.php";
    session_start();
    if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
    || empty($_SESSION['id_pessoa'])) {
    echo "<p>Não existe um usuário logado no sistema.</p>";
    echo "<a href='../FrmLogin.php'>Voltar</a>";
  } else {       
?>

  
    <main id="main" class="main-page" >
      <form  action="inserir_evento.php" method="POST" enctype="multipart/form-data" style="width: 58%;margin:auto;">
        <div class="form-group col-md-12" >
            <div class="form-row" ><br>
              <h1><a>Evento</a></h1>
              
              <p>Para cadastrar seu evento insira os seguintes dados:</p>
              
  
              <label for="nome">Nome do evento</label><br>
              <input type="text" name="nome" class="form-control" required autofocus><br>
              
              <label for="descricao">Descrição</label><br>
              <textarea name="descricao" id="descricao" maxlength="350" rows="5" cols="50" class="form-control" required autofocus></textarea><br>
              
              <label for="classificacao">Classificação indicativa</label><br>
              <input type="text" name="classificacao" class="form-control" required autofocus><br>
              
              <label for="categoria">Categoria</label>
              <select name="cod_categoria" class="form-control">
                          
                <option value="selecione" selected>Selecione uma categoria</option> 
                    <?php 
  
                            try{
                                  
                              require_once '../conexao.php';
                              
                                $sql="select * from categoria";
  
                                $resultado = $conn->query($sql);
                                $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
    
                                foreach ($dados as $linha) {    
                                    ?> 
                                    <option value="<?php echo $linha['id_categoria'] ?>"> 
                                        <?php echo utf8_encode ($linha['descricao_categoria'] );?> 
                                    </option> 
                                    <?php 
                                
                                } 
                             
  
                              } catch(PDOException $e) {
                                echo "Connection failed: " . $e->getMessage();
                              } catch(Exception $e) {
                                echo "Erro de SQL: " . $e->getMessage();
                              }
                             
                          ?>
                         
              </select>
               
               <br>
              
              <label for="data_inicial">Data Inicial</label><br>
              <input type="date" name="data_inicial" class="form-control" required autofocus><br>
              
              <label for="data_final">Data Final</label><br>
              <input type="date" name="data_final" class="form-control" required autofocus><br>
  
              <label for="hora">Hora</label><br>
              <input type="time" name="hora" class="form-control" min="00:00" max="23:00" required autofocus><br>
              
              <label for="cod_cidade">Cidade:</label>
              <select name="cod_cidade" class="form-control">
                        
                <option value="selecione" selected>Selecione uma cidade</option> 
                  <?php 

                          try{
                                
                            
                              $sql="select * from cidade";

                              $resultado = $conn->query($sql);
                              $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
  
                              foreach ($dados as $linha) {    
                                  ?> 
                                  <option value="<?php echo $linha['id_cidade'] ?>"> 
                                      <?php echo utf8_encode ($linha['nome_cidade'] );?> 
                                  </option> 
                                  <?php 
                              
                              } 
                           

                            }catch(PDOException $e) {
                              echo "Connection failed: " . $e->getMessage();
                            }
                            catch(Exception $e) {
                              echo "Erro de SQL: " . $e->getMessage();
                            }
                            
                           
                        ?>
              </select>
              
               <br>
             
              <label for="valor_ingresso">Valor do ingresso</label><br>
              <input type="text" name="valor_ingresso" required autofocus class="valor_ingresso form-control" ><br>
              

              <label for="pessoa">Pessoas</label>
              <select name="cod_pessoa[]" class="form-control" multiple="multiple">
                          
                <option value="selecione" selected>Selecione as Pessoas</option> 
                    <?php 
  
                            try{
                                  
                              require_once '../conexao.php';
                              
                                $sql="select * from pessoa";
  
                                $resultado = $conn->query($sql);
                                $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
    
                                foreach ($dados as $linha) {    
                                    ?> 
                                    <option value="<?php echo $linha['id_pessoa'] ?>"> 
                                        <?php echo utf8_encode ($linha['nome_pessoa'] );?> 
                                    </option> 
                                    <?php 
                                
                                } 
                             
  
                              } catch(PDOException $e) {
                                echo "Connection failed: " . $e->getMessage();
                              } catch(Exception $e) {
                                echo "Erro de SQL: " . $e->getMessage();
                              }
                             
                          ?>
                         
              </select>
               
               <br>


              <label for="foto">Foto</label><br>
              <input type="file" name="arquivo" class="form-control" required autofocus><br><br>
              
              <button type="submit" name="entrar" class="btn btn-outline-success" style="background:#cccccc" >Cadastrar</button>
              <button  type="reset" class="btn btn-outline-danger" style="background: #ff6666" >Limpar</button><br><br>

            </div>
          
        </div>
                
                  
              
      </form>
        
    </main>
  
    <?php

  }

?>
</body>
</html>

