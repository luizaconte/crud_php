<?php
    require_once "../topo2.php";
    require_once "../conexao.php";
    
?>
    <body>
        <?php

        if(isset($_POST['descricao'])){

            $descricao=$_POST['descricao'];
        

        try {
                
                $sql = "
                insert into tipo(descricao_tipo) values ('$descricao');";
            
                $conn->exec($sql);
                ?>
                
                <div class="alert alert-success" role="alert">
                    Cadastrado com sucesso!
                </div>  
            
                <meta http-equiv='Refresh' content='0.5;URL=../tipo/listar_tipo.php'>

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
  
    ?>
        
       

    </body>
</html>
