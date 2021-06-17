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
            
            $id_evento = $_GET['id_evento'];
            
            $sql = "delete from item_evento where cod_evento = $id_evento";
            $conn->exec($sql);

            $sql2 = "delete from evento where id_evento = $id_evento";
            $conn->exec($sql2);

            ?>
            
            <div class="alert alert-success" role="alert">
                    Excluído com sucesso!
            </div>
            
            
            <meta http-equiv='Refresh' content='0.5;URL=../evento/listar_evento.php'>
                
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
