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
        <?php
        
        try{
            require '../conexao.php';
            $id_tipo = $_POST ["id_tipo"];
            $descricao = $_POST ["descricao"];

            $sql = "UPDATE tipo SET descricao_tipo = '$descricao' WHERE id_tipo = $id_tipo";
            
            $conn->exec($sql);

            ?>
             
             <div class="alert alert-success" role="alert">
                     Dados alterados com sucesso!
             </div>
             
             <meta http-equiv='Refresh' content='0.5;URL=../tipo/listar_tipo.php'>
            
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
