<?php
// Inicializa a sessão
  session_start();
//verifica se está logado
  if ($_SESSION["logado"] != "ok"){
   // volta para login
    header("Location: ./home.php");
  }
?>


<?php

  // Remove mensagem de alerta
  error_reporting(1);

  include_once "./conexao_bd.php";

  // Obtém ID via GET
  $id_post = $_GET["id_post"];
  $id_usuario = $_SESSION["id_usuario"];


  // Esqueceu de passar o ID?
  if ($id_post == NULL) {
    echo "O ID do post não foi passado! <br>";
  }

 
      $sql = "DELETE FROM post 
              WHERE id_post = '$id_post' AND cod_usuario = '$id_usuario'";
       // Executa no BD
    $retorno = $conexao->query($sql);

      // Executou?
    if ($retorno == true) {
    echo "<script>
            Location: javascript:history.back(1)
          </script>";

  } else {

    echo "<script>
            alert('Erro ao apagar post!');
          </script>";

    // Exibe do erro que o banco retorna
    echo $conexao->error;
  }
?> 