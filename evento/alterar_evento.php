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
        
        if(isset($_POST['nome']) && isset($_POST['id_evento']) && isset($_POST['data_inicial'])
          && isset($_POST['data_final']) && isset($_POST['hora']) 
          && isset($_POST['cod_cidade']) && isset($_POST['descricao'])
          && isset($_POST['cod_categoria']) && isset($_POST['classificacao'])
          && isset($_POST['valor_ingresso']) ){

            
            require_once "../conexao.php";

            $id=$_POST["id_evento"];
            $nomeE = $_POST["nome"];
            $dataI = $_POST["data_inicial"];
            $dataF = $_POST["data_final"];
            $hora = $_POST["hora"];
            $cidade = $_POST["cod_cidade"];
            $descricao = $_POST["descricao"];
            $categoria = $_POST["cod_categoria"];
            $classificacao = $_POST["classificacao"];
            $valor_ingresso= $_POST["valor_ingresso"];
            $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
            $nomeF = $_FILES[ 'arquivo' ][ 'name' ];

            if($arquivo_tmp==""){

                try{

                    $sql = "update evento set nome_evento='$nomeE',data_inicial_evento='$dataI',
                    hora_evento='$hora',descricao_evento='$descricao',data_final_evento='$dataF',
                    valor_ingresso_evento='$valor_ingresso',classificacao_evento='$classificacao',
                    cod_categoria=$categoria,cod_cidade=$cidade where id_evento=$id";
        

                    $conn->exec($sql);

                        ?>
                            
                            <div class="alert alert-success" role="alert">
                                    Dados alterados com sucesso!
                            </div>
                            
                            <meta http-equiv='Refresh' content='0.5;URL=../evento/mostra_evento.php?id_evento=<?php  echo $id;?>'>
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
                    $sqlA = "update evento set nome_evento='$nomeE',data_inicial_evento='$dataI',
                    hora_evento='$hora',descricao_evento='$descricao',data_final_evento='$dataF',
                    valor_ingresso_evento='$valor_ingresso',classificacao_evento='$classificacao',
                    cod_categoria=$categoria,cod_cidade=$cidade,foto_evento='$foto' 
                    where id_evento=$id";
        
                           
                    
                        $conn->exec($sqlA);
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
