<?php
        
        require_once "./topo.php";
        require_once "./conexao.php";
        session_start();
        if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
            || empty($_SESSION['id_pessoa'])) {
            echo "<p>Não existe um usuário logado no sistema.</p>";
            echo "<a href='./FrmLogin.php'>Voltar</a>";
        } else {
    
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
          <li><a href="categoria/listar_categoria.php">Categorias</a></li>
          <li><a href="cidade/listar_cidade.php">Cidade</a></li>
          <li><a href="tipo/listar_tipo.php">Tipo</a></li>
          <li><a href="FrmLogin.php">Login</a></li>          
        </ul>
      </nav>
    </div>
  </header>



  <main id="main">
    <section id="intro">

      <div class="intro-container">
        
        <h1 class="mb-4 pb-0">Best <br><span>Choice</span></h1>
        <p class="mb-4 pb-0">Sistema para busca de contratantes e profissionais de eventos culturais.</p>
      
      </div>
    </section>


    <section id="gallery" class="wow fadeInUp">

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

  </main>

  <?php

      }
        
        require_once "./rodape.php";
    
    ?>


</body>

</html>
