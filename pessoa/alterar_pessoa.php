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
        
        if(isset($_POST['nome']) && isset($_POST['login'])
          && isset($_POST['senha']) && isset($_POST['tipo']) 
          && isset($_POST['descricao']) && isset($_POST['telefone'])
          && isset($_POST['data_nascimento']) && isset($_POST['endereco'])
          && isset($_POST['sexo']) && isset($_POST['email']) 
          && isset($_POST['cod_cidade']) ){

            
            require_once "../conexao.php";

            $id=$_POST['id_pessoa'];
            $nomep=$_POST['nome'];
            $login=$_POST['login'];
            $senha=$_POST['senha'];
            $tipo_pessoa=$_POST['tipo'];
            $descricao = $_POST['descricao'];
            $telefone=$_POST['telefone'];
            $data_nascimento=$_POST['data_nascimento'];
            $endereco=$_POST['endereco'];
            $sexo=$_POST['sexo'];
            $email=$_POST['email'];
            $cidade=$_POST['cod_cidade'];
            $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];

            if($arquivo_tmp==""){

                try{

                    $sql="UPDATE pessoa SET nome_pessoa='$nomep',
                    endereco_pessoa='$endereco',cod_cidade =$cidade,
                    telefone_pessoa='$telefone',data_nascimento_pessoa='$data_nascimento',
                    sexo_pessoa='$sexo',cod_tipo=$tipo_pessoa,email_pessoa='$email',senha_pessoa='$senha',
                    login_pessoa='$login', descricao_pessoa='$descricao' 
                    Where id_pessoa=$id";

                    $conn->exec($sql);

                        ?>
                            
                            <div class="alert alert-success" role="alert">
                                    Dados alterados com sucesso!
                            </div>
                            
                            <meta http-equiv='Refresh' content='0.5;URL=../pessoa/listar_pessoa.php'>
                        <?php
                    
                }catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
                catch(Exception $e) {
                    echo "Erro de SQL: " . $e->getMessage();
                }
                $conn = null;

            }else{

                $nome = $_FILES[ 'arquivo' ][ 'name' ];

                // Pega a extensão
                $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );

                // Converte a extensão para minúsculo
                $extensao = strtolower ( $extensao );

                
                if ( strstr ( '.jpg;.jpeg;.png', $extensao ) ) {
                    
                    // Cria um nome único para esta imagem
                    $novoNome = uniqid ( time () ) . '.' . $extensao;

                    // Concatena a pasta com o nome
                    $destino = '../imagens/'.$novoNome;
                    $foto='imagens/'.$novoNome;
                    
                    // tenta mover o arquivo para o destino
                    if (move_uploaded_file($arquivo_tmp, $destino)){

                    }
                    else {
                        echo 'Erro ao salvar o arquivo. <br />';
                    }
            
                } else {
                    echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
                }

    
                try {
                    
                    require_once '../conexao.php';
                    $sql="UPDATE pessoa SET nome_pessoa='$nomep',
                     endereco_pessoa='$endereco',cod_cidade =$cidade,
                     telefone_pessoa='$telefone',data_nascimento_pessoa='$data_nascimento',
                     sexo_pessoa='$sexo',cod_tipo=$tipo_pessoa,email_pessoa='$email',
                     senha_pessoa='$senha',login_pessoa='$login',foto_pessoa='$foto' 
                     Where id_pessoa=$id";
                           
                    
                        $conn->exec($sql);
                        ?>
                        
                        <div class="alert alert-success" role="alert">
                            Alterado com sucesso!
                        </div>  
                    
                        <meta http-equiv='Refresh' content='0.5;URL=../pessoa/listar_pessoa.php'>

                    <?php

                    
                    } catch(PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                    catch(Exception $e) {
                        echo "Erro de SQL: " . $e->getMessage();
                    }
                    $conn = null;


                } //fim else
        }// fim if isset
        else {
            ?>
                <div class="alert alert-danger" role="alert">
                        Não foi possível alterar!
                </div>
               
            <?php
        }
    }
    
    ?>
       
    </body>
</html>
