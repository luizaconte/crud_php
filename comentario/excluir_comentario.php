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
            
            $id_comentario = $_GET['id'];
            
            $sql = "delete from comentario where id_comentario = $id_comentario";
            
            $conn->exec($sql);

            ?>
            
            <div class="alert alert-success" role="alert">
                    Excluído com sucesso!
            </div>
            
            
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
