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


     $sql = "SELECT *
             FROM amizade
             where cod_enviado = '$id_usuario' and cod_recebido = '$id_amigo'";


	//Executa no BD		
        $retorno = $conexao->query($sql);
	//Verificar se deu erro
        if($retorno == false){
        	echo $conexao->error;
        	exit;
        }            

	if($registro = $retorno->fetch_array()){ 
		$status = $registro["status"];


 			if ($status == 2) {
					echo "<script>
	       			 alert('Ja sao amigos!');
		                location.href='amigos.php';
		              </script>";				}else{


			echo "<script>
	                alert('Solicitacao nao pode ser feita novamente!');
	                location.href='pesquisaramigo.php';
	          </script>";
	           }

	} else {

		  $sql = "SELECT *
             FROM amizade
             where cod_enviado = '$id_amigo' and cod_recebido = '$id_usuario'";


			//Executa no BD		
		        $retorno = $conexao->query($sql);
			//Verificar se deu erro
		        if($retorno == false){
		        	echo $conexao->error;
		        	exit;
		        }            

			if($registro = $retorno->fetch_array()){ 
				
				$id_1 = $registro["cod_enviado"];
				$id_2 = $registro["cod_recebido"];
				$status = $registro["status"];


 				if ($status == 2) {
					echo "<script>
	       			 alert('Ja sao amigos!');
		                location.href='amigos.php';
		              </script>";				}

				if( $status == 1 ){
				  $status = 2; //amizade feita
				   $sql = "UPDATE amizade 
				              SET status = '$status'
				              WHERE cod_enviado = '$id_amigo'
				              AND cod_recebido = '$id_usuario'";
				  // Executa no BD
					      $retorno = $conexao->query($sql);

					      // Executou?
					      if ($retorno == true) {
					      	
					        echo "<script>
					       			 alert('Amigo adicionado!');
					                location.href='amigos.php';
					              </script>";

					      } else {

					        echo "<script>
					                alert('Erro!');
					                location.href='amigos.php';
					              </script>";

					          }
				}
				
		    } else{


		  $status = '1';
			 // Cria o comando SQL
	      $sql = "INSERT INTO amizade (cod_enviado, cod_recebido, status) 
	              VALUES ('$id_usuario', '$id_amigo', '$status')"; //status 1 amizade pendente

	      // Executa no BD
	      $retorno = $conexao->query($sql);

	      // Executou?
	      if ($retorno == true) {
	      	
	        echo "<script>
	       			 alert('Solicitacao enviada com sucesso!');
	                location.href='pesquisaramigo.php';
	              </script>";

	      } else {

	        echo "<script>
	                alert('Erro Solcitar amizade!');
	                location.href='pesquisaramigo.php';
	              </script>";

	          }
	      }
	}    

?>