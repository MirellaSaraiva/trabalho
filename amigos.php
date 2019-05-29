<?php
include_once "./topo.php";
?>

	        <style>
		              
		        #img {
		            height: 300px;

		    </style>
        <br>
         <a href="./pesquisaramigo.php"><button class="btn btn-primary" type="submit">Procurar Amigo</button></a>
        <br>
        <br>
        

		<?php
		// SOLICACAO PENDENTE
		include_once "./conexao_bd.php";
	                $id_usuario = $_SESSION["id_usuario"];

					    //Buscar no BD
	                //INNER JOIN
					$sql = "SELECT *
					        FROM amizade
					        INNER JOIN usuario
					        ON amizade.cod_enviado = usuario.id
				            WHERE cod_recebido = '$id_usuario' AND status = '1'";

						//Executa no BD		
					$retorno = $conexao->query($sql);
						//Verificar se deu erro
					 if($retorno == false){
					     echo $conexao->error;
					     exit;
					     } else{
					     	 
					     }       
				    $contador = 0;
					while ($registro = $retorno->fetch_array()){
					$contador = 1;
					if ($contador ==1){
						
					     	echo"<span class='badge badge-primary'>Solicicao Pendente</span>";
					     	
					        
					}$contador = $contador + 1 ;


					$id_enviado = $registro["cod_enviado"];

									$nome = $registro["nome"];
									$user = $registro["username"];
								    $pic = $registro["foto"];
								    $id_user = $registro["id"];

									echo "  <div class='col-md-2'>
												<div class='card' style='width: 18rem;''>
												  <img src='$pic' class='card-img-top' id='img' alt='...'>
												  <div class='card-body'>
												    <h5 class='card-title'> $nome </h5>
												    <p class='card-text'> @$user </p>
												    <a href='./add.php?id_user=$id_user' class='btn btn-primary'>Aceitar Amigo <i class='fas fa-user-friends'></i></a>
												    <a onclick=\"return confirm('Deseja recusar?');\" class='btn btn-danger' href='./delete.php?id_user=$id_user'>Recusar Amigo<i class='fas fa-user-slash'></i></a>
													<a href='./profile.php?id_user=$id_user' class='btn btn-primary'>Ver Profile <i class='fas fa-address-card'></i></a>
												  </div>
												</div>
											</div>
											
									         ";
					
				}
				echo "	<div class ='row'>";
		?>
		</div>
		<p><span class="badge badge-primary">Seus amigos</span></p>

				<center>
				     	<div class="row">
<?php
                        //INNER JOIN
					    //Buscar no BD
					$sql = "SELECT *
					        FROM amizade
					        INNER JOIN usuario
					        ON amizade.cod_enviado = usuario.id
				            WHERE  amizade.cod_recebido = '$id_usuario' AND amizade.status = '2' ";

						//Executa no BD		
					$retorno = $conexao->query($sql);
						//Verificar se deu erro
					 if($retorno == false){
					     echo $conexao->error;
					     exit;
					     }         
				    
				    $contador = 1;

					while ($registro = $retorno->fetch_array()){


					$id_amigo = $registro["cod_enviado"];
				    //Buscar no BD
									$nome = $registro["nome"];
									$user = $registro["username"];
								    $pic = $registro["foto"];
								    $id_user = $registro["id"];

									echo "    <div class='col-md-4'>
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
											
								         ";


				}
				    //Buscar no BD
					$sql = "SELECT *
					        FROM amizade
					        INNER JOIN usuario
					        ON amizade.cod_recebido = usuario.id
				            WHERE  amizade.cod_enviado = '$id_usuario' AND amizade.status = '2' ";

						//Executa no BD		
					$retorno = $conexao->query($sql);
						//Verificar se deu erro
					 if($retorno == false){
					     echo $conexao->error;
					     exit;
					     }         
				    $contador = 1;
					while ($registro = $retorno->fetch_array()){

					$contador = $contador + 1;
					$id_amigo = $registro["cod_recebido"];

									$nome = $registro["nome"];
									$user = $registro["username"];
								    $pic = $registro["foto"];
								    $id_user = $registro["id"];

									echo "   <div class='col-md-4'>
												<div class='card' style='width: 23rem;''>
												  <img src='$pic' class='card-img-top' alt='...' id='img'>
												  <div class='card-body'>
												    <h5 class='card-title'> $nome </h5>
												    <p class='card-text'> @$user </p>
									
													<a href='./profile.php?id_user=$id_user' class='btn btn-primary'>Ver Profile <i class='fas fa-address-card'></i></a>
													<a onclick=\"return confirm('Deseja Apagar?');\" class='btn btn-danger' href='./delete.php?id_user=$id_user'>Deletar Amigo<i class='fas fa-user-slash'></i></a>
												  </div>
												</div>
											</div>
									         ";

				    
				}

?>
 			
				</div>
				</center>






<?php
include_once "./rodape.php";
?>