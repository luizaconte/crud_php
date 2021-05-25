<?php
    require_once "../topo2.php";
            
?>

  
    <main id="main" class="main-page" >
        <form action="inserir_pessoa.php" method="POST" enctype="multipart/form-data" style="width: 58%;margin:auto;">
            <div class="form-group col-md-12" >
                <div class="form-row" >   
                  <br>
                    
                  <h1><a>Pessoa</a></h1>
                  
                  <label for="nome">Nome:</label>
                  <input type="text" name="nome" class="form-control" required autofocus>
                  
                  <br><label for="descricao">Descrição</label><br>
                  <input type="text" name="descricao" minlength="10" maxlength="150" class="form-control" required autofocus placeholder="descreva seu trabalho"><br>
                  
                  <label for="telefone">Telefone:</label>
                  <input type="tel" name="telefone" class="form-control"   required autofocus placeholder="(99) 999999999">
                  
                  <br>
                
                  <label for="data_nascimento">Data de Nascimento:</label>
                  <input type="date" name="data_nascimento" class="form-control" required autofocus>
                  
                  <br>
                  
                  <label for="endereco">Endereço:</label>
                  <input type="text" name="endereco" class="form-control" required autofocus>
                  
                  <br>
                  
                  <label for="cod_cidade">Cidade:</label>
                  <select name="cod_cidade" class="form-control">
                        
                        <option value="selecione" selected>Selecione uma cidade</option> 
                        <?php 

                          try{
                                
                            require_once '../conexao.php';
                            
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
                    
                    <br/>
                    
                    <label for="tipo">Tipo</label>
                    <select name="cod_tipo" class="form-control">
                        
                        <option value="selecione" selected>Selecione um tipo</option> 
                        <?php 

                          try{
                                
                            require_once '../conexao.php';
                            
                              $sql="select * from tipo";

                              $resultado = $conn->query($sql);
                              $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
  
                              foreach ($dados as $linha) {    
                                  ?> 
                                  <option value="<?php echo $linha['id_tipo'] ?>"> 
                                      <?php echo utf8_encode ($linha['descricao_tipo'] );?> 
                                  </option> 
                                  <?php 
                              
                              } 
                           

                            } catch(PDOException $e) {
                              echo "Connection failed: " . $e->getMessage();
                            } catch(Exception $e) {
                              echo "Erro de SQL: " . $e->getMessage();
                            }
                            $conn = null;
                           
                        ?>
                       
                    </select>
                    <br>
        
                    <label for="sexo">Sexo:</label><br>
                    <input type="radio" name="sexo" value="Feminino" >Feminino
                    <input type="radio" name="sexo" value="Masculino"  >Masculino
                  
                    <br><br>
        
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" class="form-control" required autofocus placeholder="bestchoit@i.ua">
                    
                    <br>

                    <label for="login">Login:</label>
                    <input type="text" name="login" class="form-control" required autofocus>
                    
                    <br>
                    
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" class="form-control" minlength="8" maxlength="20"  required autofocus>
                    
                    <br>
                    
                      <label for="arquivo">Foto:</label>
                    <input type="file" name="arquivo" class="form-control"  required autofocus>
                    
                    <br><br>

                    <button type="submit" name="entrar" class="btn btn-outline-success" style="background:#a1a1a1; color:#fff" >Cadastrar</button>
                    <button  type="reset" class="btn btn-outline-danger" style="background: #ff6666; color:#fff" >Limpar</button><br><br>
                    
                    </div>
                </div>
          </form> 
        
    </main>
    
  </body>
</html>
