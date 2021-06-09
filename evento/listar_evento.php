<?php

  require_once "../topo2.php";
  require_once '../conexao.php';

  session_start();
    if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
        || empty($_SESSION['id_pessoa'])) {
        echo "<p>Não existe um usuário logado no sistema.</p>";
        echo "<a href='../FrmLogin.php'>Voltar</a>";
    } else {
    
?>

  <main id="main" class="main-page">

    <table style="border:0" cellpadding="5" >
        <tr>
            <td ALIGN=MIDDLE WIDTH=150 ><b>Nome </b></td>
            <td ALIGN=MIDDLE WIDTH=150><b>Descrição </b></td>
            <td ALIGN=MIDDLE WIDTH=150><b>Categoria </b></td>
            <td ALIGN=MIDDLE WIDTH=150><b>Data </b></td>
            <td ALIGN=MIDDLE WIDTH=150><b>Hora </b></td>
            <td ALIGN=MIDDLE WIDTH=150><b>Cidade </b></td>
            <td></td>
        </tr>

      <?php

        try{
        
            $sql="Select DATE_FORMAT(E.data_inicial_evento,'%d/%m/%Y') as dataiE,DATE_FORMAT(E.data_final_evento,'%d/%m/%Y') as datafE,E.id_evento,E.nome_evento,E.descricao_evento,E.classificacao_evento,E.hora_evento,"
            . "C.nome_cidade,Ca.descricao_categoria From Categoria Ca inner join Evento E On E.cod_categoria=Ca.id_categoria INNER JOIN Cidade C "
            . "ON E.cod_cidade = C.id_cidade WHERE STATUS_EVENTO='ATIVO'";
    
            $resultado = $conn->query($sql);
            $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <h3>Cadastrar <a href="frm_evento.php">novo</a> evento</h3>

            <?php

                foreach ($dados as $linha) { 


                    $id = $linha['id_evento'];
                    $nome = $linha['nome_evento'];
                    $desc= $linha['descricao_evento'];
                    $classificacao=$linha['classificacao_evento'];
                    $categoria=$linha['descricao_categoria'];
                    $dataI=$linha['dataiE'];
                    $hora=$linha['hora_evento'];
                    $cidade=$linha['nome_cidade'];
            
                    ?>
                
                    <tr>
                        <td ALIGN=MIDDLE WIDTH=150><?php  echo utf8_encode($nome);?></td>
                        <td ALIGN=MIDDLE WIDTH=150><?php  echo $classificacao ;?></td>
                        <td ALIGN=MIDDLE WIDTH=150><?php  echo utf8_encode($categoria );?></td>
                        <td ALIGN=MIDDLE WIDTH=150><?php  echo $dataI ;?></td>
                        <td ALIGN=MIDDLE WIDTH=150><?php  echo $hora ;?></td>
                        <td ALIGN=MIDDLE WIDTH=150><?php  echo utf8_encode( $cidade);?></td>
                        <td><a href="mostra_evento.php?id_evento=<?php  echo $id;?>" target="_parent" >Ver mais</a></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>   

                    <?php
            
            
                }
            
            

        }catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        catch(Exception $e) {
            echo "Erro de SQL: " . $e->getMessage();
        }
 
    ?>

    </table>

</main> 
   


</body>
<?php
  }
?>
</html>