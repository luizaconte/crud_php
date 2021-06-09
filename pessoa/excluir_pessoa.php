<?php
    require_once "../topo2.php";
    session_start();
    if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
        || empty($_SESSION['id_pessoa'])) {
        echo "<p>Não existe um usuário logado no sistema.</p>";
        echo "<a href='../FrmLogin.php'>Voltar</a>";
    } else {
?>
        <?php
            require '../conexao.php';
            
            if(isset($_GET['id_pessoa'])){

                $id_pessoa=$_GET["id_pessoa"];
            
                
                try {
                    $sql = "delete from pessoa where id_pessoa = $id_pessoa";

                    $conn->exec($sql);
                    
                    ?>
            
                        <div class="alert alert-success" role="alert">
                            Excluído com sucesso!
                            </div>
                        <meta http-equiv='Refresh' content='1;URL=listar_pessoa.php'>
                        
                    <?php

                } catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                    }
                  catch(Exception $e) {
                    echo "Erro de SQL: " . $e->getMessage();
                    }
                $conn = null;

            }else{
            ?>
            <div class="alert alert-danger" role="alert">
                Não foi possível excluir!
                </div>
            
            <?php
            }   
        }
            ?>
       
    </body>
</html>
