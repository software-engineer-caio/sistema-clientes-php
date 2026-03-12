<?php
// Dados do banco de dados
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "clientesdb";

// Conecta ao banco
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

// Se não conectar, mostra o erro
if (!$conexao) {
    die("Erro na conexão: " . mysqli_connect_error());
}
?>
