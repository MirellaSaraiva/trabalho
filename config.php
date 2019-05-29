<?php include_once "./topo.php"; ?>
<?php

  $id_usuario = $_SESSION["id_usuario"];


  // Clicou em enviar? O POST Existe?
  if ($_POST != NULL) {

  // Não exibe msg alerta
  error_reporting(1);
   
  // Conecta ao BD
  include_once "./conexao_bd.php";


    // Obtem dados do POST
    $nome = $_POST["nome"];
    $username = $_POST["username"];
    $senha = $_POST["senha"];
    $senhaconf = $_POST["senhaconf"];
    $foto = $_POST["foto"];

    //addslashes() <- evita SQL Injection quado for fazer um SELECT

    // Valida campos obrigatórios
    if ($nome != "" && $username != "" && $foto != "" && $senha == $senhaconf ) {



      // Cria o comando SQL
      $sql = "UPDATE usuario 
               SET  nome = '$nome',
                    username = '$username',
                    senha = MD5('$senha'), 
                    foto = '$foto' 
              WHERE id = '$id_usuario'";

      // Executa no BD
      $retorno = $conexao->query($sql);

      // Executou?
      if ($retorno == true) {

        echo "<script>
                alert('Dados alterados com Sucesso!');
                location.href='principal.php';
              </script>";
       $_SESSION["nome_usuario"] = $nome;
       $_SESSION["username"] = $username;
       $_SESSION["foto"] = $foto; 

      } else {

        echo "<script>
                alert('Erro ao Alterar dados!');
              </script>";


        // Exibe do erro que o banco retorna
        echo $conexao->error;

      }

    } else {
        echo "<script>
                alert('Preencha todos os campos!');
              </script>";
    }

  }

?>

<?php

    $nome_session = $_SESSION["nome_usuario"];
    $username_session = $_SESSION["username"];
    $foto_session = $_SESSION["foto"];
 ?>


 <br>
	<div class="jumbotron jumbotron-fluid">
	  <div class="container">
	    <h1 class="display-4">Editar Dados</h1>
	  </div>
	</div>
 <br>

<form method="POST">

	<div class="input-group mb-3">
	  <div class="input-group-prepend">
	    <span class="input-group-text" id="basic-addon1">Nome do Usuario</span>
	  </div>
	  <input type="text" name="username" maxlength="100" class="form-control" value=<?php echo"'$username_session'"; ?>   required>
	</div>


  <div class="input-group mb-3">
    <div class="input-group-prepend">
	    <span class="input-group-text" id="basic-addon1">Nome</span>
	</div>
    <input type="text" name="nome" maxlength="50"  class="form-control" value=<?php echo"'$nome_session'"; ?> required>
  </div>

  <div class="input-group mb-3">
    <div class="input-group-prepend">
	    <span class="input-group-text" id="basic-addon1">Senha</span>
	  </div>
    <input type="password" name="senha" class="form-control" required>
  </div>

  <div class="input-group mb-3">
    <div class="input-group-prepend">
	    <span class="input-group-text" id="basic-addon1">Confirma Senha</span>
	  </div>
    <input type="password" name="senhaconf" class="form-control" required>
  </div>

  <div class="input-group mb-3">
    <div class="input-group-prepend">
	    <span class="input-group-text" id="basic-addon1">URL da Foto</span>
	  </div>
    <input type="text" name="foto"  class="form-control" value=<?php echo"'$foto_session'"; ?> required >
  </div>

  <button class="btn btn-primary" type="submit">Salvar</button>
  
</form>

  <?php include_once "./rodape.php"; ?>