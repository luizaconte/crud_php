
<?php
        
    //conexão com banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=best_choice", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    catch(Exception $e) {
        echo "Erro de SQL: " . $e->getMessage();
    }
?>
  