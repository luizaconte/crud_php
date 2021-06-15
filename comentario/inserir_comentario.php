<?php
    require_once "../topo2.php";
    session_start();

    if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
        || empty($_SESSION['id_pessoa'])) {
        echo "<p>Não existe um usuário logado no sistema.</p>";
        echo "<a href='../FrmLogin.php'>Voltar</a>";
    } else {
        require_once '../conexao.php';
        

        if(isset($_POST['texto']) && isset($_POST['id_evento'])) {

            
            $id_pessoa=$_SESSION['id_pessoa'];
            $texto=$_POST['texto'];
            $id_evento=$_POST['id_evento'];
            try {
                
                $sql = "insert into comentario(texto_comentario,cod_pessoa,cod_evento) values ('$texto',$id_pessoa,$id_evento)";
    
                $conn->query($sql);
                
                ?>
                    <div class="alert alert-success" role="alert">
                        Comentário salvo com sucesso!
                    </div> 

                    
                    <meta http-equiv='Refresh' content='0.5;URL=../evento/mostra_evento.php'> 
                  
                <?php

                    

            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            catch(Exception $e) {
                echo "Erro de SQL: " . $e->getMessage();
            }
            $conn = null;


        

        }
         
    }
        ?>
    </body>
</html>
