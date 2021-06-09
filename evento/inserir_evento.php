<?php
    require_once "../topo2.php";
    require_once "../conexao.php";
    session_start();
    if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
    || empty($_SESSION['id_pessoa'])) {
    echo "<p>Não existe um usuário logado no sistema.</p>";
    echo "<a href='../FrmLogin.php'>Voltar</a>";
} else {
    
        
        if(isset($_POST['nome']) && isset($_POST['data_inicial'])
          && isset($_POST['data_final']) && isset($_POST['hora']) 
          && isset($_POST['descricao']) && isset($_POST['cod_categoria'])
          && isset($_POST['classificacao']) && isset($_POST['valor_ingresso'])
          && isset($_POST['cod_cidade'])  && isset($_POST['cod_pessoa']) ){

                
            
            $nomeE = $_POST["nome"];
            $dataI = $_POST["data_inicial"];
            $dataF = $_POST["data_final"];
            $hora = $_POST["hora"];
            $cidade = $_POST["cod_cidade"];
            $descricao = $_POST["descricao"];
            $categoria = $_POST["cod_categoria"];
            $classificacao = $_POST["classificacao"];
            $valor_ingresso= $_POST["valor_ingresso"];
            $pessoas= $_POST["cod_pessoa"];
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
                
                $sql = "insert into evento(nome_evento,data_inicial_evento,hora_evento,descricao_evento,data_final_evento,valor_ingresso_evento,classificacao_evento,cod_categoria,cod_cidade,foto_evento,status_evento) "
                . "values ('".utf8_decode($nomeE)."','$dataI','$hora','".utf8_decode($descricao)."','$dataF','R$ $valor_ingresso','$classificacao anos',$categoria,$cidade,'$foto','ATIVO')";
    
                $conn->query($sql);
                $id_evento = $conn->lastInsertId();
                
                 
                for ($i = 0; $i < count($pessoas); $i++) {
                    $sql2 = "INSERT INTO item_evento ( cod_pessoa, cod_evento) VALUES ($pessoas[$i],$id_evento)";
        
                    $conn->query($sql2);
                  }
                    
                ?>
                    <div class="alert alert-success" role="alert">
                        Evento cadastrado com sucesso!
                    </div> 

                    
                    <meta http-equiv='Refresh' content='0.5;URL=../evento/listar_evento.php'> 
                  
                <?php

                    

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
                        Não foi possível cadastrar o evento!
                </div>
               
            <?php
        }
  
    }
    ?>
       
    </body>
</html>
