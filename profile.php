<?php
include_once "./topo.php";
?>

	        <style>
		              
		        #img {
		            height: 300px;

		    </style>
		    <style>
		              
		        #img_little {
		            width: 5%;
		        }
		        
		    </style>


<?php
	// Não exibe msg alerta
	error_reporting(1);
   
	// Conecta ao BD
	include_once "./conexao_bd.php";


    $id_usuario = $_SESSION["id_usuario"];
    $nome_logado = $_SESSION["nome_usuario"];
    $username_logado = $_SESSION["username"];
    $foto = $_SESSION["foto"];
    
    $id_user = $_GET["id_user"];

    if($id_usuario != $id_user){

                     //Buscar no BD
	                 // Buscar se amigo enviou solicitacao de amiga
					$sql = "SELECT *
					        FROM amizade
					        INNER JOIN usuario
					        ON amizade.cod_enviado = usuario.id
				            WHERE amizade.cod_recebido = '$id_usuario' AND amizade.cod_enviado = '$id_user' ";

				 $retorno = $conexao->query($sql);
				//Verificar se deu erro
				 if($retorno == false){
				     echo $conexao->error;
				     exit;
				 }         
				
				if($registro = $retorno->fetch_array()){
    				$status= $registro["status"];	
    				$nome = $registro["nome"];
					$username = $registro["username"];
				    $pic = $registro["foto"];
				    echo " 
						<div class='jumbotron'>
							<div class='row'>
								<div class='col-md-9'>
										<br>
										<br>
										<br>
								  <h1 class='display-4'>$nome</h1>
								  <p class='lead'>@$username</p>
								</div>
								<div class='col-md-3'>
								  <img src='$pic' class='imgsize' id='img' alt='...'>
								</div>
						    </div>
						  <hr class='my-4'>";
 				
				    if($status == 2){
				    	echo "<a onclick=\"return confirm('Deseja Apagar?');\" class='btn btn-danger' href='./delete.php?id_user=$id_user'>Deletar Amigo<i class='fas fa-user-slash'></i></a>
						</div> ";
				    }
				    if($status == 1){
				    	echo" <a href='#' class='btn btn-primary'>Solicitacao Amigo ja enviada <i class='fas fa-user-friends'></i></a>
							</div> ";
				    }
				    if($status != 2 AND $status != 1 OR $status == NULL){
				    	echo " <a href='#' class='btn btn-primary'>Adicionar Amigo <i class='fas fa-user-friends'></i></a>
							</div> ";
				    }
 				}else{
 					$sql = "SELECT *
					        FROM amizade
					        INNER JOIN usuario
					        ON amizade.cod_recebido = usuario.id
				            WHERE amizade.cod_enviado = '$id_usuario' AND amizade.cod_recebido = '$id_user' ";

				 $retorno = $conexao->query($sql);
				//Verificar se deu erro
				 if($retorno == false){
				     echo $conexao->error;
				     exit;
				 }         
				
				if($registro = $retorno->fetch_array()){
    				$status= $registro["status"];	
    				$nome = $registro["nome"];
					$username = $registro["username"];
				    $pic = $registro["foto"];
				      echo " 
						<div class='jumbotron'>
							<div class='row'>
								<div class='col-md-9'>
										<br>
										<br>
										<br>
								  <h1 class='display-4'>$nome</h1>
								  <p class='lead'>@$username</p>
								</div>
								<div class='col-md-3'>
								  <img src='$pic' class='imgsize' id='img' alt='...'>
								</div>
						    </div>
						  <hr class='my-4'>";
 				
				    if($status == 2){
				    	echo "<a onclick=\"return confirm('Deseja Apagar?');\" class='btn btn-danger' href='./delete.php?id_user=$id_user'>Deletar Amigo<i class='fas fa-user-slash'></i></a>
						</div> ";
				    }
				    if($status == 1){
				    	echo" <a href='#' class='btn btn-primary'>Solicitacao Amigo ja enviada <i class='fas fa-user-friends'></i></a>
							</div> ";
				    }
				    if($status != 2 AND $status != 1 OR $status == NULL){
				    	echo " <a href='#' class='btn btn-primary'>Adicionar Amigo <i class='fas fa-user-friends'></i></a>
							</div> ";
				    }
 				}
 			} if($status == NULL){
 				 $sql = "SELECT *
					        FROM usuario
				            WHERE id = '$id_user' ";

				 $retorno = $conexao->query($sql);
				//Verificar se deu erro
				 if($retorno == false){
				     echo $conexao->error;
				     exit;
				 }         
				
				if($registro = $retorno->fetch_array()){
    				$status= $registro["status"];	
    				$nome = $registro["nome"];
					$username = $registro["username"];
				    $pic = $registro["foto"];
				    


 				echo " 
						<div class='jumbotron'>
							<div class='row'>
								<div class='col-md-9'>
										<br>
										<br>
										<br>
								  <h1 class='display-4'>$nome</h1>
								  <p class='lead'>@$username</p>
								</div>
								<div class='col-md-3'>
								  <img src='$pic' class='imgsize' id='img' alt='...'>
								</div>
						    </div>
						  <hr class='my-4'>
						   <a href='#' class='btn btn-primary'>Adicionar Amigo <i class='fas fa-user-friends'></i></a>
							</div> ";
 				}
 			}

 		} 

	if($id_usuario == $id_user){

		echo " 
			<div class='jumbotron'>
				<div class='row'>
					<div class='col-md-9'>
						<br>
						<br>
			     		<br>
					  <h1 class='display-4'>$nome_logado</h1>
					  <p class='lead'>@$username_logado</p>
					</div>
					<div class='col-md-3'>
					  <img src='$foto' class='imgsize' id='img' alt='...'>
					</div>
			    </div>
			  <hr class='my-4'>
			</div> ";


	}
	
    ?>



<?php

// POSTAGENS
$sql = "SELECT *
 		   FROM post
 		   inner join usuario
 		   on post.cod_usuario = usuario.id
 		   where cod_usuario = '$id_user'
 		   ORDER BY id_post DESC";

		//Executa no BD		
		$retorno = $conexao->query($sql);
		//Verificar se deu erro
		 if($retorno == false){
					     echo $conexao->error;
					     echo "<script>
	                alert('Erro ao buscar posts!');
	              </script>";

					     exit;
		 }         
				    
		while ($registro = $retorno->fetch_array()){

			$postagem = $registro["post"];
			$imagem = $registro["img"];
			$cod_usuario = $registro["cod_usuario"];
			$user = $registro["username"];
			$dia = $registro["data_post"];
			$hora = $registro["hora_post"];
			$id_post = $registro["id_post"];
			$foto_user = $registro["foto"];



				$sql = "SELECT count(id_like) as curtir 
					     FROM curtir
				         WHERE  cod_post = '$id_post'";

					//Executa no BD		
					$retorno2 = $conexao->query($sql);
						//Verificar se deu erro
					 if($retorno2 == false){
					     echo $conexao->error;
					     exit;

					  } 
					  if ($registro2 = $retorno2->fetch_array()){
					  $num_like = $registro2["curtir"];
					  }

					$sql = "SELECT count(id_coment) as comt
					     FROM comentario
				         WHERE  cd_post = '$id_post'";

					//Executa no BD		
					$retorno2 = $conexao->query($sql);
						//Verificar se deu erro
					 if($retorno2 == false){
					     echo $conexao->error;
					     exit;

					  } 
					  if ($registro2 = $retorno2->fetch_array()){
					  $num_com = $registro2["comt"];
					  }
					  $sql = "SELECT *  
					     FROM curtir
				         WHERE  cod_post = '$id_post' AND cd_usuario = '$id_usuario'";

					//Executa no BD		
					$retorno3 = $conexao->query($sql);
						//Verificar se deu erro
					 if($retorno3 == false){
					     echo $conexao->error;
					     exit;

					  } 
					  if ($registro3 = $retorno3->fetch_array()){
					  $curtido = '1';
					  }else{
					  	$curtido = '0';
					  }



			echo "
   			 <div class='card mb-3'>
				  <img src='$imagem'  class='card-img-top' alt='...'>
				  <div class='card-body'>
				    <h5 class='card-title'>$postagem</h5>
				    <p><img src='$foto_user' id='img_little' alt='...' class='img-thumbnail'><a href='./profile.php?id_user=$cod_usuario'>@$user</a></p>
				    <p class='card-text'><small class='text-muted'> $num_like curtidas e $num_com comentarios </small></p>
				    <p class='card-text'><small class='text-muted'>Postado em: $dia , $hora </small></p>";

				    if ($curtido == 1){
				    	echo "<a href='./like.php?id_post=$id_post&acao=2' class='btn btn-primary'>Descurtir <i class='far fa-thumbs-down'></i></a>";
				    } else{
				    	echo"

				    <a href='./like.php?id_post=$id_post&acao=1' class='btn btn-primary'>Curtir <i class='fas fa-thumbs-up'></i></a>";}
				    echo "
				    <a href='./comentar.php?id_post=$id_post' class='btn btn-primary'>Ver Comentarios/Comentar <i class='fas fa-comments'></i></a>";


			if($id_usuario == $cod_usuario){
				echo "<a onclick=\"return confirm('Deseja deletar postagem?');\" class='btn btn-danger' href='./apagar_post.php?id_post=$id_post'>Deletar Post <i class='far fa-trash-alt'></i></a>";
			}
			
			echo "    
				  </div>
			</div>
			";
		}

?>


<?php
include_once "./rodape.php";
?>