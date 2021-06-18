<?php

  require_once '../topo2.php';
  require_once '../conexao.php';

  session_start();
    if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
        || empty($_SESSION['id_pessoa'])) {
        echo "<p>Não existe um usuário logado no sistema.</p>";
        echo "<a href='../FrmLogin.php'>Voltar</a>";
    } else {
        
        
        $id_pessoa=$_GET['id_pessoa'];
        
        
        $sql="Select p.descricao_pessoa,P.id_pessoa,p.email_pessoa,t.id_tipo,c.id_cidade,T.descricao_tipo, C.nome_cidade,p.nome_pessoa,p.telefone_pessoa,DATE_FORMAT(p.data_nascimento_pessoa,'%d/%m/%Y') as data_nascimento_pessoa,p.endereco_pessoa,p.sexo_pessoa,p.login_pessoa,p.senha_pessoa,p.foto_pessoa From tipo t inner Join pessoa p on t.id_tipo=p.cod_tipo inner join cidade c on c.id_cidade=p.cod_cidade where p.id_pessoa=$id_pessoa and p.cod_tipo!=1";
       
        $resultado = $conn->query($sql);
        $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
        
        
        foreach ($dados as $linha) { 
        
          $desc= $linha['descricao_pessoa'];
          $nomep=$linha['nome_pessoa'];
          $telefone=$linha['telefone_pessoa'];
          $data_nascimento=$linha['data_nascimento_pessoa'];
          $endereco=$linha['endereco_pessoa'];
          $sexo=$linha['sexo_pessoa'];
          $email=$linha['email_pessoa'];
          $foto=$linha['foto_pessoa'];
          $id_tipo=$linha['id_tipo'];
          $nometipo=$linha['descricao_tipo'];
          $nome_cidade=$linha['nome_cidade'];
        }
        
        ?>
    

  <main id="main" class="main-page">

    <section id="speakers-details" >
      <div class="container">
          <div class="section-header">
            <h2><?php echo utf8_encode($nomep); ?></h2>
            <p> O profissional para o seu evento!</p>
          </div>

          <div class="row">
              <div class="col-md-6">
                <img src="../<?php echo $foto?>"  class="img-responsive">
              </div>

              <div class="col-md-6">
                <div class="details">
                    <h4 ><?php echo utf8_encode($desc);?></h4>
                    <h4><?php echo '<a>Data de Nascimento:</a>'.$data_nascimento?></h4>
                    <h4><?php echo '<a>Endereço:</a> '.$endereco ?></h4>
                    <h4><?php echo '<a>Sexo:</a> '.$sexo?></h4>
                    <h4><?php echo '<a>Telefone:</a> '.$telefone ?></h4>
                    <h4><?php echo '<a>E-mail:</a>'.$email ?></h4>
                  </div>
                </div>
            </div>
          
      </div>

    </section>

  </main>

  <?php
  }
?>

</body>
</html>