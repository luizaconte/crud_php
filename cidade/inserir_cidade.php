<?php
    require_once "../topo2.php";
    session_start();
    if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
        || empty($_SESSION['id_pessoa'])) {
        echo "<p>Não existe um usuário logado no sistema.</p>";
        echo "<a href='../FrmLogin.php'>Voltar</a>";
    } else {

            if(isset($_POST['nome_cidade']) && isset($_POST['cod_estado'])){

                $cidade=$_POST['nome_cidade'];
                $estado=$_POST['cod_estado'];

                
                try {

                    require '../conexao.php';
            
                    $sql = "insert into cidade(nome_cidade,cod_estado) values ('$cidade',$estado);";
            
                    $conn->exec($sql);
                    ?>
                
                    <div class="alert alert-success" role="alert">
                        Cadastrado com sucesso!
                    </div>  
                
                    <meta http-equiv='Refresh' content='0.5;URL=../cidade/listar_cidade.php'>
    
                <?php
                }
                catch(PDOException $e) {
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
        
        }    
       ?>
       
    </body>
</html>
