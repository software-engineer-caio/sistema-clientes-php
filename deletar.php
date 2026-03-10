<?php
include 'conexao.php';

if (isset($_POST['cpf'])) {

    $cpf = $_POST['cpf'];

    if (empty($cpf)) {
        echo "Informe o CPF para excluir!";
    } else {

        $sql = "DELETE FROM clientes WHERE cpf='$cpf'";

        if (mysqli_query($conexao, $sql)) {
            echo "Cliente excluído com sucesso!";
        } else {
            echo "Erro: " . mysqli_error($conexao);
        }

        mysqli_close($conexao);
    }
}

echo '<br><br><button onclick="window.history.back()">Voltar</button>';
?>
