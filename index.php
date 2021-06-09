<?php
        
        require_once "./topo.php";
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

  </main>

  <?php

      }
        
        require_once "./rodape.php";
    
    ?>


</body>

</html>
