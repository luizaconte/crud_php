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

  <header id="header" class="header-fixed">
    <div class="container" >

    <div id="logo" class="pull-left">
        <a href="../index.php#intro" class="scrollto"><img src="../img/logo.png" alt="logo Best Coice" title=""></a>
    </div>

      <nav id="nav-menu-container">
        
      </nav><!-- #nav-menu-container -->
  
    </div>
  </header><!-- #header -->

  <main id="main" class="main-page">
      <?php

        try{
          require_once '../conexao.php';
        
          $sql = "Select * From tipo ORDER BY descricao_tipo";
          $resultado = $conn->query($sql);
          $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
          ?>
          <br><br>
          <h3 >Cadastrar <a href="frm_tipo.php">novo</a> tipo</h3>

          <?php

              foreach ($dados as $linha) { 
                $id_tipo = $linha ['id_tipo'];
                $descricao=$linha['descricao_tipo'];
 
                echo "<b>Código:</b>".$id_tipo.
                      "<br>".
                      "<b>Descrição:</b>".$descricao.
                      "<br>";
        ?>
        
            <a href="frm_alterar_tipo.php?id_tipo=<?php echo $id_tipo;?>" >Alterar</a> 
            <a href="excluir_tipo.php?id_tipo=<?php echo $id_tipo;?>" >Excluir</a><br><br>
        
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