<?php
include 'conexao.php';

if (isset($_POST['cpf'], $_POST['nome'], $_POST['email'], $_POST['telefone'])) {

    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    if (empty($cpf)) {
        echo "Informe o CPF do cliente!";
    } else {

        $sql = "UPDATE clientes SET 
                nome='$nome',
                email='$email',
                telefone='$telefone'
                WHERE cpf='$cpf'";

        if (mysqli_query($conexao, $sql)) {
            echo "Cliente atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar: " . mysqli_error($conexao);
        }

        mysqli_close($conexao);
    }
}

echo '<br><br><button onclick="window.history.back()">Voltar</button>';
?>
