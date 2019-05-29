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

	// Não exibe msg alerta
	error_reporting(1);
   
	// Conecta ao BD
	include_once "./conexao_bd.php";

	$id_amigo = $_GET["id_user"];
	$id_usuario = $_SESSION["id_usuario"];


		$sql = "DELETE FROM amizade
		        WHERE cod_recebido = '$id_usuario' and cod_enviado = '$id_amigo'";

	


	//Executa no BD		
        $retorno = $conexao->query($sql);
	//Verificar se deu erro
        if($retorno == false){
        	echo $conexao->error;
        echo "<script>
	                alert('Erro!');
	                location.href='amigos.php';
	          </script>";
        	exit;
        } else{
        	echo "<script>
	                alert('Amigo deletado!');
	                location.href='amigos.php';
	          </script>";
        }   
        

	$sql = "DELETE FROM amizade
		    WHERE cod_enviado = '$id_usuario' and cod_recebido = '$id_amigo'";

	//Executa no BD		
        $retorno = $conexao->query($sql);
	//Verificar se deu erro
        if($retorno == false){
        	echo $conexao->error;
        	"<script>
	                alert('Erro!');
	                location.href='amigos.php';
	          </script>";
        	exit;
        } else{
        	echo "<script>
	                alert('Amigo deletado!');
	                location.href='amigos.php';
	          </script>";
        }   
?>