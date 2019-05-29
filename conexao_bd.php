
<?php
// Conecta ao BD
$conexao = new mysqli("localhost", "root", "", "rede_social_mm");

// Deu erro ao conectar?
if ($conexao->connect_error) {
  echo "Erro de Conexão!<br>".$conexao->connect_error;
}

?>