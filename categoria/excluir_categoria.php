<?php
    require_once "../topo2.php";
    session_start();
    if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
        || empty($_SESSION['id_pessoa'])) {
        echo "<p>Não existe um usuário logado no sistema.</p>";
        echo "<a href='../FrmLogin.php'>Voltar</a>";
    } else {
        
        try{

            require '../conexao.php';
            
            $id_categoria = $_GET['id_categoria'];
            
            $sql = "delete from categoria where id_categoria = $id_categoria";
            
            $conn->exec($sql);

            ?>
            
            <div class="alert alert-success" role="alert">
                    Excluído com sucesso!
            </div>
            
            <meta http-equiv='Refresh' content='0.5;URL=../categoria/listar_categoria.php'>
            
            <?php

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        } catch(Exception $e) {
            echo "Erro de SQL: " . $e->getMessage();
        }
            
        $conn = null;
    }
            ?>
        
    </body>
</html>
