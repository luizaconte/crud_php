<?php
    require_once "../topo2.php";
    require_once "../conexao.php";
    session_start();
    if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
    || empty($_SESSION['id_pessoa'])) {
    echo "<p>Não existe um usuário logado no sistema.</p>";
    echo "<a href='../FrmLogin.php'>Voltar</a>";
  } else {
    
?>
    <body>
        <?php

        if(isset($_POST['descricao'])){

            $descricao=$_POST['descricao'];
        

        try {
                
                $sql = "insert into categoria(descricao_categoria) values ('$descricao');";
            
                $conn->exec($sql);
                ?>
                
                <div class="alert alert-success" role="alert">
                    Cadastrado com sucesso!
                </div>  
            
                <meta http-equiv='Refresh' content='0.5;URL=../categoria/listar_categoria.php'>

            <?php

    
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            catch(Exception $e) {
                echo "Erro de SQL: " . $e->getMessage();
            }
            $conn = null;

         } else {
            ?>
                <div class="alert alert-danger" role="alert">
                        Não foi possível cadastrar!
                </div>
               
            <?php
        }
    }
    ?>
        
       

    </body>
</html>
