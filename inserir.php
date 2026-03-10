<?php
include 'conexao.php';

if (
    isset(
        $_POST['nome'], $_POST['cpf'], $_POST['nascimento'],
        $_POST['nacionalidade'], $_POST['profissao'],
        $_POST['celular'], $_POST['email'], 
        $_POST['cep']
    )
) {

    $nome          = $_POST['nome'];
    $cpf           = $_POST['cpf'];
    $nascimento    = $_POST['nascimento'];
    $genero        = $_POST['genero'];
    $estadociv     = $_POST['estadociv'];
    $nacionalidade = $_POST['nacionalidade'];
    $profissao     = $_POST['profissao'];

    $celular = $_POST['celular'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $emailsec = $_POST['emailsec'];

    $cep = $_POST['cep'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $pais = $_POST['pais'];

    if (
        empty($nome) || empty($cpf) || empty($nascimento) ||
        empty($nacionalidade) || empty($profissao) ||
        empty($celular) || empty($email) || empty($cep)
    ) {
        echo "Preencha os campos obrigatórios!";
    } else {

        $sql = "INSERT INTO clientes 
        (nome, cpf, nascimento, genero, estadociv, nacionalidade, profissao,
         celular, telefone, email, emailsec,
         cep, logradouro, numero, complemento, bairro, cidade, estado, pais)
        VALUES
        ('$nome', '$cpf', '$nascimento', '$genero', '$estadociv', '$nacionalidade', '$profissao',
         '$celular', '$telefone', '$email', '$emailsec',
         '$cep', '$logradouro', '$numero', '$complemento', '$bairro', '$cidade', '$estado', '$pais')";

        if (mysqli_query($conexao, $sql)) {
            echo "Cliente cadastrado com sucesso!";
        } else {
            echo "Erro: " . mysqli_error($conexao);
        }

        mysqli_close($conexao);
    }
}

echo '<br><br><button onclick="window.history.back()">Voltar</button>';
?>
