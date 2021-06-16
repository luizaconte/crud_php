<?php

  require_once '../topo2.php';
  require_once '../conexao.php';

  session_start();
    if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
        || empty($_SESSION['id_pessoa'])) {
        echo "<p>Não existe um usuário logado no sistema.</p>";
        echo "<a href='../FrmLogin.php'>Voltar</a>";
    } else {


      $idE=$_GET['id_evento'];
        
        
        $sql = "Select DATE_FORMAT(E.data_inicial_evento,'%d/%m/%Y') as dataiE,DATE_FORMAT(E.data_final_evento,'%d/%m/%Y') as datafE,E.id_evento,E.nome_evento,E.descricao_evento,E.classificacao_evento,E.data_final_evento,E.foto_evento,E.hora_evento,"
                . "E.valor_ingresso_evento,E.status_evento,C.nome_cidade,Es.sigla_estado,Ca.descricao_categoria From Categoria Ca inner join Evento E On E.cod_categoria=Ca.id_categoria INNER JOIN Cidade C "
                . "ON E.cod_cidade = C.id_cidade INNER JOIN Estado Es ON C.cod_estado=Es.id_estado where Es.id_estado=C.cod_estado and id_evento=$idE";
        
        
        $resultado = $conn->query($sql);
        $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
        
        
        foreach ($dados as $linha) { 
            $id = $linha['id_evento'];
            $nome = $linha['nome_evento'];
            $desc= $linha['descricao_evento'];
            $classificacao=$linha['classificacao_evento'];
            $categoria=$linha['descricao_categoria'];
            $dataI=$linha['dataiE'];
            $dataF=$linha['datafE'];
            $hora=$linha['hora_evento'];
            $cidade=$linha['nome_cidade'];
            $estado=$linha['sigla_estado'];
            $valorI=$linha['valor_ingresso_evento'];
            $foto=$linha['foto_evento'];
            $status=$linha['status_evento'];
            
        }
    
?>


    <main id="main" class="main-page">

      <section id="speakers-details" >
        <div class="container"> 
          <div class="section-header">
              <h2><?php echo utf8_encode($nome); ?></h2>
          </div>
          <div class="col-md-6">
            <div class="details">
              <h4 ><?php echo utf8_encode($desc);?></h4>
              <h4><?php echo utf8_encode( '<a>Categoria:</a>'.$categoria);?></h4>
              <h4><?php echo '<a>Censura:</a> '.$classificacao ?></h4>
              <h4><?php echo '<a>Início:</a> '.$dataI.' às '.$hora.' horas'?></h4>
              <h4><?php echo '<a>Término:</a> '.$dataF ?></h4>
              <h4><?php echo '<a>Ingresso:</a> '.$valorI?></h4>
              <h4><?php echo  '<a>Localização:</a> '.utf8_encode($cidade.'<a>-</a>'.$estado);?></h4>
                  
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <img src="../<?php echo $foto?>" class="img-responsive">
            </div>
          </div>
        </div>
          
          <div style="background-color:#c4c4c4;">
                
                <hr>
                <h2>Comentários</h2>
                
                <div class="form-row" >
                      
                  <form method="POST" target="conteudo" action="../comentario/inserir_comentario.php" >
                        
                    <div class="form-group col-md-8">
                      <input  name="id_evento" type="hidden" value="<?php echo $idE?>">
                      <input class="form-control col-md-4" name="texto" type="text" placeholder="Escreva um comentário..">
                    
                    </div>
                      <div class="form-group col-md-4">
                        <button type="submit" name="comentar" class="btn btn-outline-success" style="background:#f82249 ;width: 200px; font-size: 17px;color:#fff" >
                          <b>Comentar</b>
                        </button>
                      </div> 
                    </form >
                </div>
                
            
                <iframe src="" style="background-color:#c4c4c4;" width="80%" height="500px" frameborder="0" scrolling="auto" name="conteudo" >
                </iframe>   
                
                
          </div>
       
      </section>

    </main>


<?php
  }
?>

</body>
</html>