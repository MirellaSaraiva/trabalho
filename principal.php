<?php
include_once "./topo.php";
?>
	        <style>
		              
		        #img {
		            width: 5%;
		        }
		        
		    </style>

<?php
	// Não exibe msg alerta
	error_reporting(1);
   
	// Conecta ao BD
	include_once "./conexao_bd.php";


    $id_usuario = $_SESSION["id_usuario"];
    $nome = $_SESSION["nome_usuario"];
    $username = $_SESSION["username"];

	//Buscar no BD
	    $sql = "SELECT *
	            FROM amizade
	            WHERE cod_recebido = '$id_usuario' AND status='1' ";

	//Executa no BD		
        $retorno = $conexao->query($sql);
	//Verificar se deu erro
        if($retorno == false){
        	echo $conexao->error;
        	exit;
        }            

	if($registro = $retorno->fetch_array()){ 
		$solicitacao = 1;
	}else{
		$solicitacao = 0;
	}          

    //Buscar no BD
	    $sql = "SELECT foto
	            FROM usuario
	            WHERE id = '$id_usuario'";

	//Executa no BD		
        $retorno = $conexao->query($sql);
	//Verificar se deu erro
        if($retorno == false){
        	echo $conexao->error;
        	exit;
        }            

	if($registro = $retorno->fetch_array()){ 
    $foto = $registro["foto"];

	}
	else{
		//sem foto
	}

//postagem


      if ($_POST != NULL) {
      	$postagem = $_POST["postagem"];
      	$imagem = $_POST["imagem"];

      	$data = date('d/m/Y');
      	$hora = date('H:i:s');


	      	  // Cria o comando SQL
	      $sql = "INSERT INTO post (post, img, cod_usuario, data_post, hora_post) 
	              VALUES ('$postagem', '$imagem', ' $id_usuario', '$data', '$hora')";

	      // Executa no BD
	      $retorno = $conexao->query($sql);

	      // Executou?
	      if ($retorno == true) {

	        echo "<script>
	                alert('Post enviado com Sucesso!');
	                location.href='principal.php';
	              </script>";

	      } else {
	        echo "<script>
	                alert('Erro ao postar!');
	              </script>";

	        // Exibe do erro que o banco retorna
	        echo $conexao->error;

	      }


	  }


?>




<br>
<div class="row">
		<div class="card col-md-3">
		  <img src= <?php echo "'$foto'" ?>  class="card-img-top" alt="...">
		  <div class="card-body">
		    <h5 class="card-title"><a href= <?php echo"'./profile.php?id_user=$id_usuario'"; ?> > <?php echo "$nome"; ?>   <i class="fas fa-address-card"></i></a></h5>
		 
		  	<p class="card-text"><?php echo "@$username " ?> </p>
		  <?php	
		  if ($solicitacao == 1) {

		  	
		  echo "
			  <ul class='list-group list-group-flush'>
			  <li class='list-group-item'>
			  	<p class='card-text'><a href='amigos.php'><i class='fas fa-user-friends'></i> Solicitacao de Amizade Pendente</a> ";
		  }
		  ?>
	</div>
	 </div>
		<div class="card col-md-9">
		  <h5 class="card-header">Feed</h5>
		  <div class="card-body">
		    <h5 class="card-title">Compartilhe sua arte</h5>
		    <form method="post">
		     <div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">@Username</label>
			      <div class="input-group mb-2">
			        <div class="input-group-prepend">
			          <div class="input-group-text"><i class="far fa-comment-alt"></i></div>
			        </div>
			        <input type="text" class="form-control" id="postagem" name="postagem" placeholder="Digite sua Postagem" required>
			      </div>
			    </div>
			     <div class="col-auto">
				      <label class="sr-only" for="inlineFormInputGroup">Arte:</label>
				      <div class="input-group mb-2">
				        <div class="input-group-prepend">
				          <div class="input-group-text"><i class="far fa-images"></i></div>
				        </div>
				        <input type="text" class="form-control" name="imagem" id="imagem" placeholder="URL da imagem" required>
				      </div>
				<br>
				<a href="#" class="card-link"><button type="submit" class="btn btn-primary">Enviar</button></a></li>
				<br>
			    
			</div>
			</form>
			<br>
		  <ul class="list-group list-group-flush">

		  <li class="list-group-item">


<?php

	$sql = "SELECT *
 		    FROM post
 		    INNER JOIN amizade
 		    ON post.cod_usuario = amizade.cod_recebido
            LEFT JOIN usuario
            ON post.cod_usuario = usuario.id
            WHERE amizade.cod_enviado = '$id_usuario' and amizade.status = '2'
            UNION
            SELECT *
 		    FROM post
 		    INNER JOIN amizade
 		    ON post.cod_usuario = amizade.cod_enviado
 		    LEFT JOIN  usuario
            ON post.cod_usuario = usuario.id
 		    WHERE  amizade.cod_recebido = '$id_usuario' and amizade.status = '2'
 		   UNION
           SELECT id_post , post, img, cod_usuario, data_post, hora_post,  NULL as id_amizade, NULL as cod_enviado, NULL AS cod_recebido, NULL AS  status , id, nome, username, senha, foto
 		   from post
 		   LEFT JOIN  usuario
           ON post.cod_usuario = usuario.id
 		   where post.cod_usuario = '$id_usuario'
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
				    <p><img src='$foto_user' id='img' alt='...' class='img-thumbnail'><a href='./profile.php?id_user=$cod_usuario'>@$user</a></p>
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

		




		  </div>
		
	</div>
</div>


<?php
include_once "./rodape.php";
?>