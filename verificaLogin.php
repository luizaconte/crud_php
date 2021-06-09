<?php
        
    require_once 'topo.php';
    require 'conexao.php';

    ?>

    <body>
        <?php

        
            try{

                if(isset($_POST['login']) && isset($_POST['senha'])){  

                    session_start();   
                    //criar variáveis
                    $login=$_POST['login'];
                    $senha=$_POST['senha'];
                    
                    //verifico se existe aquele usuario
                    $sql="select * from pessoa where login_pessoa='$login' and senha_pessoa='$senha'";

                    $resultado = $conn->query($sql);
                    $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($dados as $linha) {    
                        $_SESSION['id_pessoa']=$linha['id_pessoa'];
                        $_SESSION['nome_pessoa']=$linha['nome_pessoa'];
                        $_SESSION['cod_tipo']=$linha['cod_tipo'];
                        header("location:gerenciador.php");
                    
                    } 
                                
                    ?>
                            
                    <meta http-equiv='Refresh' content='0;URL=FrmLogin.php'>
        
                    <?php
                
                            
                }        

            }catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            catch(Exception $e) {
                echo "Erro de SQL: " . $e->getMessage();
            }
        
       ?>

    </body>
    
</html>