<?php
    require_once "../topo2.php";
    require_once "../conexao.php";
    
    if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
    || empty($_SESSION['id_pessoa'])) {
    echo "<p>Não existe um usuário logado no sistema.</p>";
    echo "<a href='FrmLogin.php'>Voltar</a>";
} else {
    
?>
        <?php
        
        if(isset($_POST['nome']) && isset($_POST['login'])
          && isset($_POST['senha']) && isset($_POST['cod_tipo']) 
          && isset($_POST['descricao']) && isset($_POST['telefone'])
          && isset($_POST['data_nascimento']) && isset($_POST['endereco'])
          && isset($_POST['sexo']) && isset($_POST['email']) 
          && isset($_POST['cod_cidade']) ){

            $nomep=$_POST['nome'];
            $login=$_POST['login'];
            $senha=$_POST['senha'];
            $tipo_pessoa=$_POST['cod_tipo'];
            $descricao = $_POST['descricao'];
            $telefone=$_POST['telefone'];
            $data_nasc=$_POST['data_nascimento'];
            $endereco=$_POST['endereco'];
            $sexo=$_POST['sexo'];
            $email=$_POST['email'];
            $cidade=$_POST['cod_cidade'];
            $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];


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
                
                $sql = "insert into pessoa(nome_pessoa, login_pessoa, senha_pessoa, telefone_pessoa, data_nascimento_pessoa, endereco_pessoa, sexo_pessoa, cod_tipo,email_pessoa, cod_cidade,foto_pessoa,descricao_pessoa) 
            values ('".utf8_decode($nomep)."','$login','$senha','$telefone','$data_nasc','$endereco','$sexo',$tipo_pessoa,'$email',$cidade,'$foto','".utf8_decode($descricao)."')";
            
                $conn->exec($sql);
                ?>
                
                <div class="alert alert-success" role="alert">
                    Pessoa cadastrada com sucesso!
                </div>  
            
                <meta http-equiv='Refresh' content='0.5;URL=../pessoa/listar_pessoa.php'>

            <?php

            // <meta http-equiv='Refresh' content='15;URL=../FrmLogin.php'>

            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            catch(Exception $e) {
                echo "Erro de SQL: " . $e->getMessage();
            }
            $conn = null;


        } else {
            ?>
                <div class="alert alert-danger" role="alert">
                        Não foi possível cadastrar a pessoa!
                </div>
               
            <?php
        }
  
    }
    ?>
       
    </body>
</html>
