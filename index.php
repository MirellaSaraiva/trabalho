<?php
	// Não exibe msg alerta
	error_reporting(1);

    // clicou enviar
	if($_POST != NULL){

   
	// Conecta ao BD
	    include_once "./conexao_bd.php";

    
    //Obter dados do formulário
		$login = addslashes($_POST["login"]); //login único
		$senha = addslashes($_POST["senha"]);
	    
	// Criptografar com MD5
	    $senha = md5($senha);

    //Buscar no BD
	    $sql = "SELECT *
	            FROM usuario
	            WHERE username = '$login' 
	            AND   senha = '$senha'";
	//Executa no BD		
        $retorno = $conexao->query($sql);
	//Verificar se deu erro
        if($retorno == false){
        	echo $conexao->error;
        	exit;
        }
    //Se encontrar, busca os dados   
        if($registro = $retorno->fetch_array()){
     		
     		$id = $registro["id"];
     		$nome = $registro["nome"];
     		$foto = $registro["foto"];

     		// Inicializa sessão
            session_start();
            // Criando variavei chamada logado e guardadndo um OK, para testar as paginas se tiver logado
            $_SESSION["logado"] = "ok";
            //guarda variáveis
            $_SESSION["id_usuario"] = $id; 
            $_SESSION["nome_usuario"] = $nome;
            $_SESSION["username"] = $login;
            $_SESSION["foto"] = $foto;

            //vai para página principal, esse comando só funciona se não tiver nenhum comando html antes
            header("Location: principal.php");

        } else{
        	echo "<script>
                  alert('Login ou senha inválido!');
                  </script>";
        }
	}

?>


<html>
	<head>
	   <meta charset="utf-8">
	   <title>Home</title>

		<!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	        <style>
		              
		        * {
		            margin: 0;
		            padding:0;
		        }
		        #img {
		            width: 45%;
		        }
		        
		     body{
		     	 background-image: url("https://wallpapercave.com/wp/wp2261891.jpg"); /* The image used */
				  background-color: #0000; /* Used if the image is unavailable */
				  height: 500px; /* You must set a specified height */
				  background-position: center; /* Center the image */
				  background-repeat: no-repeat; /* Do not repeat the image */
				  background-size: cover; /* Resize the background image to cover the entire container *
		     }
		    </style>
    </head>
	
	<body>
		
	    <br><br><br><br>
		<center>
				<div class="card" style="width: 18rem;">
					<br>
				  <img class="card-img-top" id="img" src="https://data.whicdn.com/images/52313505/large.jpg" alt="Imagem de capa do card">
				  <div class="card-body">
				    <h5 class="card-title">ThinkInk</h5>
				    <p class="card-text">Rede social voltada para divulgacao de estilos de tatuagens.</p>
				  </div>
			<form method="post">
				  <ul class="list-group list-group-flush">
				    <li class="list-group-item">
					    <div class="form-group col-md-6">
					      <label for="inputEmail4">Usuário</label>
					      <input type="text" name="login" class="form-control mb-2" id="inlineFormInput" placeholder="Nome">
					    </div>
					</li>
				    <li class="list-group-item">
				    	<div class="form-group col-md-6">
					      <label for="inputPassword4">Senha</label>
					      <input type="password" name="senha" class="form-control" id="inputPassword4" placeholder="Senha">
					    </div>
					</li>
				  </ul>
				  <div class="card-body">
				    <a href="#" class="card-link"><button type="submit" class="btn btn-primary">Entrar</button></a>
				    <a href="./cadastrar.php" class="card-link"><button type="button" class="btn btn-primary">Cadastrar</button></a>
				  </div>
				</div>
			</form>
		</center>



	</body>
</html>