<?php

  require_once "../topo2.php";
  require_once '../conexao.php';

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
        
          $sql = "Select * From cidade c inner join estado e on c.cod_estado=e.id_estado";
          $resultado = $conn->query($sql);
          $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
          ?>
          <br><br>

          <h3>Cadastrar <a href="frm_cidade.php">nova</a> cidade</h3>

          <?php

              foreach ($dados as $linha) { 
                $id_cidade = $linha ['id_cidade'];
                $nome=$linha['nome_cidade'];
                $estado=$linha['sigla_estado'];
    
                echo "<b>Código:</b>".$id_cidade.
                "<br>"."<b>Nome:</b>".$nome."<br>".
                "<b>Estado:</b>".$estado."<br>";

             
        ?>
        
            <a href="frm_alterar_cidade.php?id=<?php echo $id_cidade;?>" >Alterar</a> 
            <a href="excluir_cidade.php?id=<?php echo $id_cidade;?>" >Excluir</a><br><br>
        
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