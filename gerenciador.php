<?php
require_once "topo.php";

session_start();
if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
    || empty($_SESSION['id_pessoa'])) {
    echo "<p>Não existe um usuário logado no sistema.</p>";
    

} else {
    
    header("location:index.php");
    
}

?>