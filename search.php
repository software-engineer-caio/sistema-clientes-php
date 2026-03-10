<?php
include 'conexao.php';

$search = $_GET['search'] ?? "";

$sql = "SELECT * FROM clientes 
        WHERE nome LIKE '%$search%' 
        ORDER BY nome ASC";

$result = mysqli_query($conexao, $sql);

$clientes = [];

while ($row = mysqli_fetch_assoc($result)) {
    $clientes[] = $row;
}

echo json_encode($clientes);

mysqli_close($conexao);
?>
