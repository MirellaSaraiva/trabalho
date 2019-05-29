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
  $acao = $_GET["acao"];


  // Esqueceu de passar o ID?
  if ($id_post == NULL) {
    echo "O ID do post não foi passado! <br>";
  }
  if ($acao == 1){


  // Cria comando SQl
   $sql = "INSERT INTO curtir (cod_post, cd_usuario)
           VALUES ('$id_post', '$id_usuario')";

      // Executa no BD
    $retorno = $conexao->query($sql);

      // Executou?
    if ($retorno == true) {
    echo "<script>
           Location: javascript:history.back(1)
          </script>";

    $previous = "javascript:history.go(-1)";
    if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
  } else {

    echo "<script>
            alert('Erro ao Curtir!');
          </script>";

    // Exibe do erro que o banco retorna
    echo $conexao->error;

  }
  }


  if($acao == 2){
      $sql = "DELETE FROM curtir 
              WHERE cod_post = '$id_post' AND cd_usuario = '$id_usuario'";
       // Executa no BD
    $retorno = $conexao->query($sql);

      // Executou?
    if ($retorno == true) {
    echo "<script>
            Location: javascript:history.back(1)
          </script>";

  } else {

    echo "<script>
            alert('Erro ao Descurtir!');
          </script>";

    // Exibe do erro que o banco retorna
    echo $conexao->error;

  }
  }
?> 