
<?php
include_once "./topo.php";
?>

    <br>
		<form method="post">
			<div class="row">
				<div class="col-md-10">
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text">Username:</div>
						</div>
					   		<input type="text" class="form-control" name="username" id="username" placeholder="Pesquise Amigo novo">
					</div>
				</div>
				<div class="col-md-2">
					  <button class="btn btn-primary" type="submit">Procurar</button>
				</div>
			</div>
		</form>


<?php

      		
/// PROCURAR AMIGOS ////

      if ($_POST != NULL) {
         // Obtem dados do POST
		$username = $_POST["username"];
		$id_usuario = $_SESSION["id_usuario"];
		
		if($username != $_SESSION["username"]){   
		   $status = 0; 
			include_once "./conexao_bd.php";

					    //Buscar no BD
					$sql = "SELECT *
					        FROM usuario
					        INNER JOIN amizade
				            on usuario.id = amizade.cod_recebido
				            where usuario.username = '$username' AND amizade.cod_enviado = '$id_usuario'";

						//Executa no BD		
					$retorno = $conexao->query($sql);
						//Verificar se deu erro
					 if($retorno == false){
					     echo $conexao->error;
					     exit;
					     }            
				
					if($registro = $retorno->fetch_array()){ 
					$nome = $registro["nome"];
					$user = $registro["username"];
				    $pic = $registro["foto"];
				    $id_user = $registro["id"];
				    $status = $registro["status"];

			                    if($status == 1){

									echo "<center>
											<div class='card' style='width: 23rem;''>
											  <img src='$pic' class='card-img-top' alt='...'>
											  <div class='card-body'>
											    <h5 class='card-title'> $nome </h5>
											    <p class='card-text'> $user </p>
											    <a href='#' class='btn btn-primary'>Solitacao pendente Amigo <i class='fas fa-user-friends'></i></a>
												<a href='./profile.php?id_user=$id_user' class='btn btn-primary'>Ver Profile <i class='fas fa-address-card'></i></a>
											  </div>
											</div>
										</center>
								         ";
			                    }

					}else {



				     
				      					    //Buscar no BD
					$sql = "SELECT *
					        FROM usuario
					        INNER JOIN amizade
				            on usuario.id = amizade.cod_enviado
				            where usuario.username = '$username' AND amizade.cod_recebido = '$id_usuario'";

						//Executa no BD		
					$retorno = $conexao->query($sql);
						//Verificar se deu erro
					 if($retorno == false){
					     echo $conexao->error;
					     exit;
					     }            
				
					if($registro = $retorno->fetch_array()){ 
					$nome = $registro["nome"];
					$user = $registro["username"];
				    $pic = $registro["foto"];
				    $id_user = $registro["id"];
				    $status = $registro["status"];

				    if($status == 1){

						echo "<center>
								<div class='card' style='width: 23rem;''>
								  <img src='$pic' class='card-img-top' alt='...'>
								  <div class='card-body'>
								    <h5 class='card-title'> $nome </h5>
								    <p class='card-text'> $user </p>
								    <a href='./add.php?id_user=$id_user' class='btn btn-primary'>Aceitar Amigo <i class='fas fa-user-friends'></i></a>
								    <a onclick=\"return confirm('Deseja recusar?');\" class='btn btn-danger' href='./delete.php?id_user=$id_user'>Recusar Amigo<i class='fas fa-user-slash'></i></a>
									<a href='./profile.php?id_user=$id_user' class='btn btn-primary'>Ver Profile <i class='fas fa-address-card'></i></a>
								  </div>
								</div>
							</center>
					         ";
				    }
					

					}

				      }
				  
					
	 } 
	 if($status == 0){

   					 //Buscar no BD
					$sql = "SELECT *
					        FROM usuario
				            where username = '$username'";

						//Executa no BD		
					$retorno = $conexao->query($sql);
						//Verificar se deu erro
					 if($retorno == false){
					     echo $conexao->error;
					     exit;
					     }            
				
					if($registro = $retorno->fetch_array()){ 
					$nome = $registro["nome"];
					$user = $registro["username"];
				    $pic = $registro["foto"];
				    $id_user = $registro["id"];


						echo "<center>
								<div class='card' style='width: 23rem;''>
								  <img src='$pic' class='card-img-top' alt='...'>
								  <div class='card-body'>
								    <h5 class='card-title'> $nome </h5>
								    <p class='card-text'> $user </p>
								    <a href='./add.php?id_user=$id_user' class='btn btn-primary'>Adicionar Amigo <i class='fas fa-user-friends'></i></a>

									<a href='./profile.php?id_user=$id_user' class='btn btn-primary'>Ver Profile <i class='fas fa-address-card'></i></a>
								  </div>
								</div>
							</center>
					         ";
					     }
 
	}if ($status == 2){
											echo "<center> 
											   <div class='col-md-4'>
												<div class='card' style='width: 23rem;''>
												  <img src='$pic' class='card-img-top' id='img' alt='...' id='img'>
												  <div class='card-body'>
												    <h5 class='card-title'> $nome </h5>
												    <p class='card-text'> @$user </p>
												
													<a href='./profile.php?id_user=$id_user' class='btn btn-primary'>Ver Profile <i class='fas fa-address-card'></i></a>
													<a onclick=\"return confirm('Deseja Apagar?');\" class='btn btn-danger' href='./delete.php?id_user=$id_user'>Deletar Amigo<i class='fas fa-user-slash'></i></a>
												  </div>
												</div>
											</div>
											</center>
								         ";
	}


			}
	 

?>

<?php
include_once "./rodape.php";
?>