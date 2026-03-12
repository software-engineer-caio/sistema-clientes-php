<?php
include 'conexao.php';

// Recebe o texto digitado na busca
$search = $_GET['search'] ?? "";

// Busca funcionários pelo nome usando prepared statement
$sql = mysqli_prepare($conexao, "SELECT nome, cpf, email, cidade FROM clientes WHERE nome LIKE ? ORDER BY nome ASC");

// Adiciona os % aqui, fora do SQL
$busca = "%" . $search  . "%";
mysqli_stmt_bind_param($sql, "s", $busca);
mysqli_stmt_execute($sql);
$result = mysqli_stmt_get_result($sql);

$clientes = [];
while ($row = mysqli_fetch_assoc($result)) {
    $clientes[] = $row;
}

// Retorna os resultados em JSON para o JavaScript ler
echo json_encode($clientes);

mysqli_close($conexao);
?>
