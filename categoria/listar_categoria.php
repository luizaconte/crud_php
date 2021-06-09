<?php

  require_once "../topo2.php";

  session_start();
  if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
  || empty($_SESSION['id_pessoa'])) {
  echo "<p>Não existe um usuário logado no sistema.</p>";
  echo "<a href='../FrmLogin.php'>Voltar</a>";
} else {
    
       ?>

<main id="main" class="main-page">

       <?php
            require '../conexao.php';
            

            $sql = "Select * From categoria ORDER BY descricao_categoria";
            $resultado = $conn->query($sql);
            $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <h3 >Cadastrar <a href="frm_categoria.php">nova</a> categoria</h3>

            <?php

              foreach ($dados as $linha) { 
                $id_categoria = $linha ['id_categoria'];
                $descricao=$linha['descricao_categoria'];
 
             echo "Código:".$id_categoria."<br>"."Descrição:".$descricao."<br>";
        
            
    
        ?>
        
        <a href="form_alterar_categoria.php?id_categoria=<?php echo $id_categoria;?>" >Alterar</a>
        <a href="excluir_categoria.php?id_categoria=<?php echo $id_categoria;?>" >Excluir</a><br><br>
        
        
        <?php
    }
  }
  ?>
    </body>
</html>
