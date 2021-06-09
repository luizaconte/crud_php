<?php
    require_once "../topo2.php";
    session_start();

    if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
        || empty($_SESSION['id_pessoa'])) {
        echo "<p>Não existe um usuário logado no sistema.</p>";
        echo "<a href='../FrmLogin.php'>Voltar</a>";
    } else {
        require '../conexao.php';
        

        if(isset($_GET['id_pessoa']) || isset($_POST['texto']) ||
        isset($_POST['id_evento'])) {

            
            $id_pessoa=$_GET['id_pessoa'];
            $texto=$_POST['texto'];
            $id_evento=$_POST['id_evento'];

        }
         
    }
        ?>
    </body>
</html>
