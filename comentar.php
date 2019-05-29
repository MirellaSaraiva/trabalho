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
	    $id_post = $_GET["id_post"];



		if ($_POST != NULL) {

		$coment = $_POST["comentario"];
		$data = date('d/m/Y');	
          // Cria comando SQl
			   $sql = "INSERT INTO comentario (cd_post, id_usuario, comentario, data_comentario)
			           VALUES ('$id_post', '$id_usuario', '$coment', '$data')";

			      // Executa no BD
			    $retorno = $conexao->query($sql);

			      // Executou?
			    if ($retorno == false) {

			    echo "<script>
			            alert('Erro ao Curtir!');
			          </script>";

			    // Exibe do erro que o banco retorna
			    echo $conexao->error;

			  }

		}




// POSTAGENS
$sql = "SELECT *
 		   FROM post
 		   inner join usuario
 		   on post.cod_usuario = usuario.id
 		   where id_post = '$id_post'
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

				    <a href='./like.php?id_post=$id_post&acao=1' class='btn btn-primary'>Curtir <i class='fas fa-thumbs-up'></i></a><br>";}


				$sql = "SELECT *
					     FROM comentario
					     INNER JOIN usuario
					     on comentario.id_usuario = usuario.id 
				         WHERE  comentario.cd_post = '$id_post'";

				//Executa no BD		
				$retorno4 = $conexao->query($sql);
				//Verificar se deu erro
				 if($retorno4 == false){
							     echo $conexao->error;
							     echo "<script>
			                alert('Erro ao buscar comentarios!');
			              </script>";

							     exit;
				 }      

				while ($registro4 = $retorno4->fetch_array()){

					$comentario = $registro4["comentario"];
					$id_us = $registro4["id_usuario"];
					$coment_data = $registro4["data_comentario"];
					$user_name = $registro4["nome"];

					echo" <div class='row'>
								<div class='col-md-10'>
									 <p><b>@$user_name:</b> $comentario 
						    	 </div>
							    <div class='col-md-2'>
									 <small> $coment_data </small></p><br><br>
							    </div> 
					      </div>";
                             
			    }


?> 
				 
				    <br>
				    <form method="post">
						<div class="row">
							<div class="col-md-10">
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text">Comentario:</div>
									</div>
								   		<input type="text" class="form-control" name="comentario" id="comentario" placeholder="Digite seu comentario">
								</div>
							</div>
							<div class="col-md-2">
								  <button class="btn btn-primary" type="submit">Enviar</button>
							</div>
						</div>
					</form>

<?php
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