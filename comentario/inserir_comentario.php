<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../img/favicon.png" rel="icon">
        <link href="../img/apple-touch-icon.png" rel="apple-touch-icon">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">
        <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="../lib/animate/animate.min.css" rel="stylesheet">
        <link href="../lib/venobox/venobox.css" rel="stylesheet">
        <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <link href="../css/style.css" rel="stylesheet">
    </head>
    <body>
<?php
    require_once '../conexao.php';
    session_start();

    if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
        || empty($_SESSION['id_pessoa'])) {
        echo "<p>Não existe um usuário logado no sistema.</p>";
        echo "<a href='../FrmLogin.php'>Voltar</a>";
    } else {
        

        if(isset($_POST['texto']) && isset($_POST['id_evento'])) {

            
            $id_pessoa=$_SESSION['id_pessoa'];
            $texto=$_POST['texto'];
            $id_evento=$_POST['id_evento'];
            try {
                
                $sql = "insert into comentario(texto_comentario,cod_pessoa,cod_evento) values ('$texto',$id_pessoa,$id_evento)";
    
                $conn->query($sql);

                $sqlComentario="select C.id_comentario,C.cod_pessoa,C.cod_evento,C.texto_comentario,P.id_pessoa,P.nome_pessoa from comentario C inner Join pessoa P on C.cod_pessoa=P.id_pessoa where cod_evento=$id_evento";
                $resultado = $conn->query($sqlComentario);
                $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
                
    
                foreach ($dados as $linha) { 
                
                ?>
                    <div class="form-row" style="background-color:#c4c4c4;">
                        <div class="form-group col-md-8">
                            
                        <a>
                            <?php 
                            echo $linha['nome_pessoa']."<br><br>";                            
                            ?>
                        </a>
                        <?php 
                            echo $linha['texto_comentario'];
                            ?>
                            <br><hr>
                        </div>
                    </div>
                <?php
                }
                    

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
