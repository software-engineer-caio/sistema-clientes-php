<?php
include 'conexao.php';

$sql = "SELECT * FROM clientes ORDER BY nome ASC";
$resultado = mysqli_query($conexao, $sql);

echo "<h2>Lista de Clientes</h2>";

if (mysqli_num_rows($resultado) > 0) {
    echo "<table border='1' cellpadding='8'>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Email</th>
                <th>Cidade</th>
            </tr>";

    while($linha = mysqli_fetch_assoc($resultado)) {
        echo "<tr>
                <td>".$linha['nome']."</td>
                <td>".$linha['cpf']."</td>
                <td>".$linha['email']."</td>
                <td>".$linha['cidade']."</td>
              </tr>";
    }

    echo "</table>";

} else {
    echo "Nenhum cliente encontrado.";
}

mysqli_close($conexao);

echo '<br><br><button onclick="window.history.back()">Voltar</button>';
?>
