<?php
  require_once "topo.php";
  session_start();
  session_destroy();
?>


    <body>
	
    <header id="header" class="header-fixed">
      <div class="container">

        <div id="logo" class="pull-left">
          <a href="index.php#intro" class="scrollto"><img src="img/logo.png" alt="" title=""></a>
        </div>

        <nav id="nav-menu-container">
          <ul class="nav-menu">
            
            </ul>
        </nav><!-- #nav-menu-container -->
      </div>
    </header><!-- #header -->
        
      <main id="main" class="main-page">
    
        
        <form action="verificaLogin.php" method="POST">
		
          <br>

          <h1>Login</h1>
          
          <br>

            <p>Para continuar faça login.</p>
            <br>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="login">Login:</label>
                <input type="text" name="login" class="form-control" required autofocus>
                
                <br><br>
                
                <label for="senha">Senha:</label>
                <input type="password" name="senha" class="form-control"  required autofocus>
                
                <br><br>
                
                <button type="submit" name="entrar" class="btn btn-outline-success" style="background:#cccccc" >Entrar</button>
                <button  type="reset" class="btn btn-outline-danger" style="background: #ff6666" >Limpar</button><br><br>
               </div>
            </div>
          </form>     
        </main>
    
    
    </body>
</html>
