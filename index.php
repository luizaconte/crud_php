<?php
        
        require_once "./topo.php";
        require_once "./conexao.php";
        session_start();
        if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
            || empty($_SESSION['id_pessoa'])) {
            echo "<p>Não existe um usuário logado no sistema.</p>";
            echo "<a href='./FrmLogin.php'>Voltar</a>";
        } else {

          $tipo_pessoa=$_SESSION['cod_tipo'];
    
    ?>
<body>

  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
       	
          <a href="#intro" class="scrollto"><img src="img/logo.png" alt="logo Best Coice" title=""></a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="index.php">Início</a></li>
          <li><a href="evento/frm_evento.php">Eventos</a></li>
          <li><a href="pessoa/listar_pessoa.php">Pessoas</a></li>
          <?php

            if($tipo_pessoa = 3){

              echo '
                <li><a href="categoria/listar_categoria.php">Categorias</a></li>
                <li><a href="cidade/listar_cidade.php">Cidade</a></li>
                <li><a href="tipo/listar_tipo.php">Tipo</a></li>
                <li><a href="FrmLogin.php">Login</a></li> 
              ';


            }
          
          ?>         
        </ul>
      </nav>
    </div>
  </header>



  <main id="main">
    <section id="intro">

      <div class="intro-container wow fadeIn">
        
        <h1 class="mb-4 pb-0">Best <br><span>Choice</span></h1>
        <p class="mb-4 pb-0">Sistema para busca de contratantes e profissionais de eventos culturais.</p>
      
      </div>
    </section>

    <?php

    
      if($tipo_pessoa = 1 or $tipo_pessoa= 3){

        echo '
        <section id="about">
          <div class="container">
            <div class="row">
              <div class="col-lg-6">
                  <h2><a>Eventos</a></h2>
                
              </div>
                
              <div class="col-lg-3">
                  <h3>É organizador? Cadastre seu evento!</h3>
                  <p>Clique<a href="evento/frm_evento.php"> aqui</a> para cadastrar seu evento.</p><br><br>
              </div>
              <div class="col-lg-3">
                <h3>Procura por um evento?</h3>
                <p>Clique<a href="evento/listar_evento.php"> aqui</a> e encontre-o!</p>
              </div>
            </div>
          </div>
        </section>';
      }
    
    ?>

    


    <section id="gallery">

      <div class="container">
        <div class="section-header">
          
          <p>Selecione um evento para obter mais informações.</p>
        </div>
      </div>

      <div class="owl-carousel gallery-carousel">
          
        <?php
          
            $sql = "Select DATE_FORMAT(E.data_inicial_evento,'%d/%m/%Y') as dataiE,DATE_FORMAT(E.data_final_evento,'%d/%m/%Y') as datafE,E.id_evento,E.nome_evento,E.descricao_evento,E.classificacao_evento,E.data_final_evento,E.foto_evento,E.hora_evento,"
                    . "E.valor_ingresso_evento,E.status_evento,C.nome_cidade,Es.sigla_estado,Ca.descricao_categoria From Categoria Ca inner join Evento E On E.cod_categoria=Ca.id_categoria INNER JOIN Cidade C "
                    . "ON E.cod_cidade = C.id_cidade INNER JOIN Estado Es ON C.cod_estado=Es.id_estado where E.status_evento='ATIVO'";
            
            $resultado = $conn->query($sql);
            $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
                    
                
            foreach ($dados as $linha) { 
                $idEvento = $linha['id_evento'];
                $foto=$linha['foto_evento'];
                
                ?>
                  <a href="evento/mostra_evento.php?id_evento=<?php echo $idEvento?>" data-gall="gallery-carousel">
                    <img src="<?php echo $foto;?>" class="img-responsive">
                  </a>
                  
                <?php
            }
        
        
      ?>
        
        
      </div>

    </section>

    <?php

    
      if($tipo_pessoa = 2 or $tipo_pessoa= 3){

        ?>
        
        <section id="speakers" class="wow fadeInUp">
          <section id="about">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-6">
                          <h2><a>Profissionais</a></h2>
                      
                      </div>
                      <div class="col-lg-3">
                          <h3>Trabalha em eventos culturais?</h3>
                          <p>Clique<a href="pessoa/FrmPessoa.php"> aqui</a> e cadastre-se!</p>
                      </div>
                     
                  </div>
              </div>
          </section>
    
        <br>

        <div class="container">
            <div class="section-header">
                <h2>Profissionais</h2>
                <p>Encontre um profissional para seu evento.</p>
            </div>

        <div class="row">
          <?php
        
            $sql = "Select * From pessoa p where p.cod_tipo=2";


            
            $resultado = $conn->query($sql);
            $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
        
        
            foreach ($dados as $linha) { 

        
              $id_p=$linha['id_pessoa'];   
              $nomep=$linha['nome_pessoa'];
              $descricaop= $linha['descricao_pessoa'];
              $fotop=$linha['foto_pessoa'];
      
              ?>
                <div class="col-lg-4 col-md-6">
                  <div class="speaker">
                    <img src="<?php echo $fotop;?>" class="img-fluid">
                    
                    <div class="details">
                        <h3><a href="pessoa/mostra_pessoa.php?id_pessoa=<?php echo $id_p?>"><?php echo utf8_encode($nomep);?></a></h3>
                        <p><?php echo utf8_encode($descricaop);?></p>
                    </div>
                  </div>
                </div>
              <?php
        }
       
        
        
        ?>
         
         
        </div>
      </div>

    </section>


    


    <?php
      }
    
    ?>

  </main>

  <?php

      }
        
        require_once "./rodape.php";
    
    ?>


</body>

</html>
