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
        
        try{

            require '../conexao.php';
            
            $id_comentario = $_GET['id'];
            $id_evento = $_GET['id_evento'];
            
            $sql = "delete from comentario where id_comentario = $id_comentario";
            
            $conn->exec($sql);

            

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        } catch(Exception $e) {
            echo "Erro de SQL: " . $e->getMessage();
        }
            
        $conn = null;
    }
            ?>
        
    </body>
</html>
