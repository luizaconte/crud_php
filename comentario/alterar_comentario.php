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
                $id_comentario = $_POST ["id_comentario"];
                $id_evento = $_POST ["id_evento"];
                $texto_comentario = $_POST ["texto_comentario"];

                $sql = "UPDATE comentario SET texto_comentario = '$texto_cidade' WHERE id_comentario = $id_comentario";
                
                $conn->exec($sql);

                ?>
                
                <div class="alert alert-success" role="alert">
                        Dados alterados com sucesso!
                </div>
                
                <meta http-equiv='Refresh' content='0.5;URL=../evento/mostra_evento.php?id_evento=<?php echo $id_evento;?>'>
                
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
