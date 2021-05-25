<?php

  require_once "../topo2.php";

  session_start();
    if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
        || empty($_SESSION['id_pessoa'])) {
        echo "<p>Não existe um usuário logado no sistema.</p>";
        echo "<a href='FrmLogin.php'>Voltar</a>";
    } else {
    
?>


  

  <main id="main" class="main-page">
        <?php

          try{
            require_once '../conexao.php';
          
            $sql = "Select * From pessoa ORDER BY nome_pessoa";
            $resultado = $conn->query($sql);
            $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <h3 >Cadastrar <a href="FrmPessoa.php">novo</a> usuário</h3>

            <?php

              foreach ($dados as $linha) { 

                echo  "<b>Nome:</b> " . $linha['nome_pessoa'] . "<br>" . 
                      "<b>Telefone:</b> ". $linha['telefone_pessoa'] . "<br>" .
                      "<b>Data de Nascimento:</b> " . $linha['data_nascimento_pessoa'] . "<br>" .
                      "<b>Endereço:</b> " . $linha['endereco_pessoa'] . "<br>" . 
                      "<b>Sexo:</b> ". $linha['sexo_pessoa'] ."<br>". 
                      "<b>Tipo:</b> ". $linha['cod_tipo'] ."<br>".
                      "<b>E-mail:</b> ". $linha['email_pessoa'] . "<br>". 
                      "<b>Login:</b> ". $linha['login_pessoa'] . "<br>" . 
                      "<b>Senha:</b> ". $linha['senha_pessoa'] . "<br><br>";

                    ?>

                    <div>
                      <a href="frm_alterar_pessoa.php?id_pessoa=<?php  echo  $linha['id_pessoa'];?>" >Alterar</a>
                      <a href="excluir_pessoa.php?id_pessoa=<?php  echo $linha['id_pessoa'];?>" >Excluir</a><br><br>
                    </div>
                    <?php

              }
          
        }catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        catch(Exception $e) {
            echo "Erro de SQL: " . $e->getMessage();
        }
     
   ?>
   

    </main>
      
</body>
<?php
    }
?>
</html>


