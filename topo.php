<?php
// Inicializa a sessão
  session_start();
//verifica se está logado
  if ($_SESSION["logado"] != "ok"){
   // volta para login
    header("Location: ./home.php");
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
                background-attachment: fixed;
                 background-image: url("https://d2v9y0dukr6mq2.cloudfront.net/video/thumbnail/4XZpHBm/color-jet-of-ink-pigments-dripping-down-creating-organic-color-smoke-cloud-that-fills-the-underwater-space-blue-color-clouds-and-red-color-flowing-under-water-mixing-color-drop_v1gjzula__F0002.png"); /* The image used */
                background-color: #0000; /* Used if the image is unavailable */
                height: 700px; /* You must set a specified height */
                background-position: fixed; /* Center the image */
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
    