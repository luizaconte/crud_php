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
        
        try{
                require '../conexao.php';
                $id_cidade = $_POST ["id_cidade"];
                $nome_cidade = $_POST ["nome_cidade"];
                $cod_estado = $_POST ["cod_estado"];

                $sql = "UPDATE cidade SET nome_cidade = '$nome_cidade', cod_estado= $cod_estado WHERE id_cidade = $id_cidade";
                
                $conn->exec($sql);

                ?>
                
                <div class="alert alert-success" role="alert">
                        Dados alterados com sucesso!
                </div>
                
                <meta http-equiv='Refresh' content='0.5;URL=../cidade/listar_cidade.php'>
                
                <?php
            }catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            catch(Exception $e) {
                echo "Erro de SQL: " . $e->getMessage();
            }
                $conn = null;
            
            ?>
    </body>

    <?php

            }
    ?>
</html>
