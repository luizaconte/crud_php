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

                $sql = "UPDATE comentario SET texto_comentario = '$texto_comentario' WHERE id_comentario = $id_comentario";
                
                $conn->exec($sql);

                ?>
                
                <div class="alert alert-success" role="alert">
                        Dados alterados com sucesso!
                </div>
                
               
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
