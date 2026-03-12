<?php
include 'conexao.php';

// Função que valida se o CPF é válido
function validaCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);

    if (strlen($cpf) != 11) return false;
    if (preg_match('/(\d)\1{10}/', $cpf)) return false;

    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) return false;
    }
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recebe os dados do formulário
    $nome          = $_POST['nome'];
    $cpf           = $_POST['cpf'];
    $nascimento    = $_POST['nascimento'];
    $genero        = $_POST['genero'];
    $estadociv     = $_POST['estadociv'];
    $nacionalidade = $_POST['nacionalidade'];
    $profissao     = $_POST['profissao'];
    $celular       = $_POST['celular'];
    $telefone      = $_POST['telefone'];
    $email         = $_POST['email'];
    $emailsec      = $_POST['emailsec'];
    $cep           = $_POST['cep'];
    $logradouro    = $_POST['logradouro'];
    $numero        = $_POST['numero'];
    $complemento   = $_POST['complemento'];
    $bairro        = $_POST['bairro'];
    $cidade        = $_POST['cidade'];
    $estado        = $_POST['estado'];
    $pais          = $_POST['pais'];

    // Checa se os campos obrigatórios estão preenchidos
    if (empty($nome) || empty($cpf) || empty($nascimento) ||
        empty($nacionalidade) || empty($profissao) ||
        empty($celular) || empty($email) || empty($cep)) {
        $erro = "Preencha todos os campos obrigatórios!";

    } elseif (!validaCPF($cpf)) {
        $erro = "CPF inválido!";

    } else {
        // Verifica se o CPF já está cadastrado (usando prepared statement)
        $verifica = mysqli_prepare($conexao, "SELECT cpf FROM clientes WHERE cpf = ?");
        mysqli_stmt_bind_param($verifica, "s", $cpf);
        mysqli_stmt_execute($verifica);
        $resultado = mysqli_stmt_get_result($verifica);

        if (mysqli_num_rows($resultado) > 0) {
            $erro = "Este CPF já está cadastrado!";
        } else {
            // Insere o funcionário no banco (usando prepared statement)
            $sql = mysqli_prepare($conexao, "INSERT INTO clientes
                    (nome, cpf, nascimento, genero, estadociv, nacionalidade, profissao,
                     celular, telefone, email, emailsec,
                     cep, logradouro, numero, complemento, bairro, cidade, estado, pais)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // "s" = string, um "s" para cada ? acima
            mysqli_stmt_bind_param($sql, "sssssssssssssssssss",
                $nome, $cpf, $nascimento, $genero, $estadociv, $nacionalidade, $profissao,
                $celular, $telefone, $email, $emailsec,
                $cep, $logradouro, $numero, $complemento, $bairro, $cidade, $estado, $pais
            );

            if (mysqli_stmt_execute($sql)) {
                $sucesso = "Funcionário cadastrado com sucesso!";
            } else {
                $erro = "Erro ao cadastrar: " . mysqli_error($conexao);
            }

            mysqli_close($conexao);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img src="itaularanja.png" class="banner" alt="Itaú">

    <main class="container">
        <div class="feedback-card">
            <?php if (isset($sucesso)): ?>
                <div class="feedback-icon sucesso">✓</div>
                <h2 class="feedback-titulo sucesso-txt"><?= $sucesso ?></h2>
                <p class="feedback-sub">O funcionário foi salvo no banco de dados.</p>
                <div class="feedback-acoes">
                    <a href="index.html" class="btn-primary">Cadastrar outro</a>
                    <button onclick="window.history.back()" class="btn-secundario">Voltar</button>
                </div>

            <?php elseif (isset($erro)): ?>
                <div class="feedback-icon erro">✕</div>
                <h2 class="feedback-titulo erro-txt"><?= $erro ?></h2>
                <div class="feedback-acoes">
                    <button onclick="window.history.back()" class="btn-primary">Voltar e corrigir</button>
                </div>

            <?php else: ?>
                <p>Nenhum dado recebido.</p>
                <button onclick="window.history.back()" class="btn-primary">Voltar</button>
            <?php endif; ?>
        </div>
    </main>

    <footer class="rodape">
        <p>Gerenciamento de Funcionários &mdash; Itaú Unibanco</p>
    </footer>
</body>
</html>
