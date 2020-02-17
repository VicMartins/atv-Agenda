<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/bc58fc4108.js" crossorigin="anonymous"></script>
  <script src="components/loader.js"></script>
  <script src="components/jquery-3.4.1.min.js"></script>
  <script src="components/acao.js"></script>

  <link rel="stylesheet" href="components/loader.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  
</head>
    <script type="text/javascript" >
    $(document).on("click", "#salvar", function(){
      $(":input").val() = "";
    });
    </script>
<body>

 <div class="container">
 <div class="jumbotron">
     <div class="row">
     <div class="col-xs-12">
        <h2 style="font-family:verdana; color: black; text-align:center;" class="titulo">Contatos </h2>
        </div>
        </div>
  <!-- inicio do corpo do texto, inputs -->
  <div class="corpo">
      <form class="" action="#" method="post">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group" >
              <label for="">Nome:</label>
              <input type="text" class="form-control" placeholder="ex:Luiza Martins" name="nomeAgenda" required>
        </div>
          </div>
            </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group" >
              <label for="">E-mail:</label>
              <input type="text" class="form-control" placeholder="example@email.com" name="emailAgenda" required >
        </div>
          </div>
            </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group" >
              <label for="">Telefone:</label>
              <input type="text" class="form-control" placeholder="(00)0000-0000" name="telAgenda" required>
        </div>
          </div>
            </div>
  </div>
          <!--botões -->
          <div class="botao">
            <div class="row">
             <div class="col-xs-6">
              <div class="form-group">
              <button type="submit" class="btn btn-dark " id="salvar"> Gravar <i class="far fa-save"></i></button>
             </div>
              </div>
              <div class="col-xs-6">
                <div class="form-group">
                <button class="btn btn-dark " id="adicionarNovo"> Adicionar <i class="far fa-list-alt"></i></button>
              </div>
              </div>
              </div>
          </div>
          </form>

          <?php

          if (!empty($_POST))
          {
            include_once("conexao.php");
              $nome = $_POST['nomeAgenda'];
              $email = $_POST['emailAgenda'];
              $tel = $_POST['telAgenda'];

              $stmt = $con->prepare("INSERT INTO tb_pessoa(nm_pessoa, ds_email, nr_telefone) 
              VALUES(?, ?, ?)");

              $stmt->bindParam(1,$nome);
              $stmt->bindParam(2,$email);
              $stmt->bindParam(3,$tel);
        
 
              $stmt->execute();
          }

          ?>
          <!-- exibiçao dos nomes em forma de tabela  -->
          <div class="row">

          <div class="card" style="width: ;">
          <table class="table table-condensed">
            <tr>
                <th>Nome</th>
                <th>E-Mail</th>
                <th>Telefone</th>
                <th colspan="2">Opções</th>
            </tr>
  
   
   
  </div>
</div>
          <?php
              include_once('conexao.php');
            try
            {
                $select = $con->prepare('SELECT * FROM tb_pessoa');
                $select -> execute();

                while($linha = $select -> fetch())
                {
                      echo "<tr>";
                      echo "<td>".$linha['nm_pessoa']."</td> ";
                      echo "<td>".$linha['ds_email']."</td>";
                      echo "<td>".$linha['nr_telefone']."</td>";
                      
                   
        ?>  
              
              <td>  <button class="buto" type="submit" id="btnEnviar" onclick="location.href='alterarPessoa.php?codigo=<?php echo $linha['cd_pessoa'];?>'"> Alterar</button> </td>
              <td> <button class="buto" type="reset" onclick="location.href='excluirPessoa.php?codigo=<?php echo $linha['cd_pessoa'];?>'"> Excluir</button> </td>

        <?php
                echo "</tr>"; 
                }
            }
            catch(PDOException $e)
            {
                echo 'ERROR: '. $e->getMessage();
            }

        ?>
          
          </table>
  </div>
</div>
</body>
</html>