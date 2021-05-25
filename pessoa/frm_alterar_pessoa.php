<?php
    require_once "../topo2.php";

    session_start();
    if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
        || empty($_SESSION['id_pessoa'])) {
        echo "<p>Não existe um usuário logado no sistema.</p>";
        echo "<a href='FrmLogin.php'>Voltar</a>";
    } else {

?>
        
        <?php

        try{
        
          require_once '../conexao.php';
          
          $id_pessoa=$_GET['id_pessoa'];
          
          //carregando a foto
          $sqlFoto="select foto_pessoa 
                    from pessoa 
                    where id_pessoa=$id_pessoa";
          
          $resultadoFoto = $conn->query($sqlFoto);
          $dadosf = $resultadoFoto->fetchAll(PDO::FETCH_ASSOC);
          foreach ($dadosf as $linhaf) {
            $caminho=$linhaf['foto_pessoa'];
          }

          
          //carregando dados da pessoa
          $sqlPessoa="Select * 
          From tipo t inner Join pessoa p on t.id_tipo=p.cod_tipo 
          inner join cidade c on c.id_cidade=p.cod_cidade 
          where p.id_pessoa=$id_pessoa";
        
          $resultado = $conn->query($sqlPessoa);
          $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

          foreach ($dados as $linha) {
  
            $nomep=$linha['nome_pessoa'];
            $descricao= $linha['descricao_pessoa'];
            $login=$linha['login_pessoa'];
            $senha=$linha['senha_pessoa'];
            $telefone=$linha['telefone_pessoa'];
            $data_nascimento=$linha['data_nascimento_pessoa'];
            $endereco=$linha['endereco_pessoa'];
            $sexo=$linha['sexo_pessoa'];
            $email=$linha['email_pessoa'];
            $foto=$linha['foto_pessoa'];
            $id_tipo=$linha['id_tipo'];
            $nometipo=$linha['descricao_tipo'];
            $id_cidade=$linha['id_cidade'];
            $nome_cidade=$linha['nome_cidade'];

            if($sexo=="Feminino"){   
              $fem="checked";
              $mas="";
            }
            else{ 
                $mas="checked";
                $fem="";
            }
          }
        }
        catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
        catch(Exception $e) {
          echo "Erro de SQL: " . $e->getMessage();
        }
         
        ?>
     
         
    <main id="main" class="main-page" >
   
        <form action="alterar_pessoa.php" method="POST" enctype="multipart/form-data" style="width: 58%;margin:auto;">
          <div class="form-group col-md-12" style="background:#fff" >
            <div class="form-row" > 
                    
              <h1><a>Pessoa</a></h1>
                      
              <input type="hidden" name="id_pessoa" class="form-control" value="<?php  echo $id_pessoa;?>" >
                      
              <label for="nome">Nome:</label>
              <input type="text" name="nome" class="form-control" required autofocus  value="<?php  echo "$nomep";?>"><br>
              
              <br>

              <label for="descricao">Descrição</label><br>
              <input type="text" name="descricao" minlength="10" maxlength="150" class="form-control" required autofocus value="<?php echo utf8_encode($descricao);?>"><br>
              
              <br>

              <label for="telefone">Telefone:</label>
              <input type="tel" name="telefone" class="form-control"   required autofocus placeholder="17 999999999" value="<?php  echo "$telefone";?>"><br>
              
              <br>
            
              <label for="data_nascimento">Data de Nascimento:</label>
              <input type="date" name="data_nascimento" class="form-control" required autofocus value="<?php  echo "$data_nascimento";?>"><br>
              
              <br>
              
              <label for="endereco">Endereço:</label>
              <input type="text" name="endereco" class="form-control" required autofocus value="<?php  echo "$endereco";?>"><br>
              <br>
              
              <label for="cod_cidade">Cidade:</label>
              <select name="cod_cidade" class="form-control" required autofocus>

                    <?php 

                          try{
                                
                            require_once '../conexao.php';
                            
                              $sql="select * from cidade";

                              $resultado = $conn->query($sql);
                              $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
  
                              foreach ($dados as $linha) {    
                                  ?> 
                                  <option value="<?php echo $linha['id_cidade'] ?>"
                                  <?php if($id_cidade == $linha['id_cidade']) echo 'selected' ?>  > 
 
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
         
            
              <label for="tipo">Tipo</label>
              <select name="tipo" class="form-control" required autofocus>
                
                <?php 

                try{
                      
                  require_once '../conexao.php';
                  
                    $sql="select * from tipo";

                    $resultado = $conn->query($sql);
                    $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($dados as $linha) {    
                        ?> 
                        <option value="<?php echo $linha['id_tipo'] ?>"  
                        <?php if($id_tipo == $linha['id_tipo']) echo 'selected' ?>  > 

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
            <input type="radio" name="sexo" value="Feminino" <?php echo $fem;?> >Feminino 
            <input type="radio" name="sexo" value="Masculino" <?php echo $mas;?> >Masculino
           
            <br><br>
 
            <label for="email">E-mail:</label>
            <input type="email" name="email" class="form-control" required autofocus placeholder="bestchoit@i.ua" value="<?php  echo "$email";?>"><br>
            
            <br>

            <label for="login">Login:</label>
            <input type="text" name="login" class="form-control" required autofocus value="<?php  echo "$login";?>"><br>
            
            <br>
            
            <label for="senha">Senha:</label>
            <input type="password" name="senha" class="form-control"  required autofocus value="<?php  echo "$senha";?>"><br>
            
            <br>
            
            <label for="foto">Foto</label>
            <br><img src="../<?php echo $foto;?>" style="max-width:60%; width:40%" ><br>
            <input type="file" name="arquivo" class="form-control"  value="../<?php  echo $foto;?>"><br>
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
