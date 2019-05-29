<?php

  // Remove mensagem de alerta
  error_reporting(1);

  // Clicou em enviar? O POST Existe?
  if ($_POST != NULL) {

    include_once "./conexao_bd.php";

    // Obtem dados do POST
    $nome = $_POST["nome"];
    $username = $_POST["username"];
    $senha = $_POST["senha"];
    $senhaconf = $_POST["senhaconf"];
    $foto = $_POST["foto"];

    //addslashes() <- evita SQL Injection quado for fazer um SELECT

    // Valida campos obrigatórios
    if ($nome != "" && $username != "" && $senha != "" && $senha == $senhaconf ) {

      // Cria o comando SQL
      $sql = "INSERT INTO usuario (nome, username, senha, foto) 
              VALUES ('$nome', '$username', MD5('$senha'), '$foto')";

      // Executa no BD
      $retorno = $conexao->query($sql);

      // Executou?
      if ($retorno == true) {

        echo "<script>
                alert('Cadastrado com Sucesso!');
                location.href='principal.php';
              </script>";

      } else {

        echo "<script>
                alert('Erro ao Cadastrar!');
              </script>";

        // Exibe do erro que o banco retorna
        echo $conexao->error;

      }

    } else {
        echo "<script>
                alert('Preencha todos os campos!');
              </script>";
    }

  }

?>

<!doctype html>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title>Rede Social</title>

       <style>
                        
                  * {
                      margin: 0;
                      padding:0;
                  }
               .imgsize{
                width: 100%;

               }
                  
               body{
                 background-image: url("https://d2v9y0dukr6mq2.cloudfront.net/video/thumbnail/4XZpHBm/color-jet-of-ink-pigments-dripping-down-creating-organic-color-smoke-cloud-that-fills-the-underwater-space-blue-color-clouds-and-red-color-flowing-under-water-mixing-color-drop_v1gjzula__F0002.png"); /* The image used */
                background-color: #0000; /* Used if the image is unavailable */
                height: 700px; /* You must set a specified height */
                background-position: center; /* Center the image */
                background-repeat: no-repeat; /* Do not repeat the image */
                background-size: cover; /* Resize the background image to cover the entire container *
               }
        </style>

  </head>
  <body>

    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
  
    <!-- Navbar content -->
        <a class="navbar-brand" href="#">Rede Social</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="./principal.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./amigos.php">Meus Amigos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./config.php">Configuracoes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./logoff.php">Logoff</a>
            </li>
          </ul>
        </div>

    </nav>

  <div class="container">     
    


 <br>
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">Cadastrar</h1>
    </div>
  </div>
 <br>

<form method="POST">

  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">Nome do Usuario</span>
    </div>
    <input type="text" name="username" maxlength="100" required class="form-control">
  </div>


  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">Nome</span>
  </div>
    <input type="text" name="nome" maxlength="50" required class="form-control">
  </div>

  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">Senha</span>
    </div>
    <input type="password" name="senha" class="form-control">
  </div>

  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">Confirma Senha</span>
    </div>
    <input type="password" name="senhaconf" class="form-control">
  </div>

  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">URL da Foto</span>
    </div>
    <input type="text" name="foto" class="form-control">
  </div>

  <button class="btn btn-primary" type="submit">Salvar</button>
  
</form>
  <?php include_once "./rodape.php"; ?>