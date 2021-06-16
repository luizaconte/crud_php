<?php

  require_once "../topo2.php";

  session_start();
  if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
  || empty($_SESSION['id_pessoa'])) {
  echo "<p>Não existe um usuário logado no sistema.</p>";
  echo "<a href='../FrmLogin.php'>Voltar</a>";
} else {
    
?>
    <body>
        <?php
        
        try{
     
            $id_comentario = $_GET ["id"];
            
            require '../conexao.php';
            
            $sql = "select * from comentario c inner join evento e on c.cod_evento=e.id_evento where id_comentario=$id_comentario";

            $resultado = $conn->query($sql);
            $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
            
          foreach ($dados as $linha) {
            $id_comentario = $linha ['id_comentario'];
            $texto_comentario=$linha['texto_comentario'];
            $nome_evento=$linha['nome_evento'];
            $id_evento=$linha['id_evento'];
          } 

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
          catch(Exception $e) {
            echo "Erro de SQL: " . $e->getMessage();
          }
        
        
        ?>
      <main id="main" class="main-page" >
   

        <form action="alterar_comentario.php" method="POST">
        <div class="form-group col-md-12" style="background:#fff" >
            <div class="form-row" > 
                    
              
              <h1>Comentário</h1>
              <input type="hidden" name="id_evento" value="<?php  echo $id_evento;?>" class="form-control"  >
              <input type="hidden" name="id_comentario" value="<?php  echo $id_comentario;?>" class="form-control"  >
              <label for="evento">Evento: <?php  echo $nome_evento;?></label>
              <input type="text" name="texto_comentario" class="form-control" value="<?php  echo $texto_comentario;?>"  required autofocus><br>

              
              <button type="submit" class="btn btn-outline-success" style="background: #9acfea" >Alterar</button>
              <button  type="reset" class="btn btn-outline-danger" style="background: #ce8483" >Limpar</button><br><br>
              
              </div>
            </div>
        </form> 
      
    </main>
<?php
  }
?>
    </body>
</html>
