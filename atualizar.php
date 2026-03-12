<?php
include 'conexao.php';

if (isset($_POST['cpf'], $_POST['nome'], $_POST['email'], $_POST['telefone'])) {

    $cpf      = $_POST['cpf'];
    $nome     = $_POST['nome'];
    $email    = $_POST['email'];
    $telefone = $_POST['telefone'];

    if (empty($cpf)) {
        $erro = "Informe o CPF do funcionário!";
    } else {
        // Atualiza os dados no banco usando prepared statement
        $sql = mysqli_prepare($conexao, "UPDATE clientes SET nome=?, email=?, telefone=? WHERE cpf=?");
        mysqli_stmt_bind_param($sql, "ssss", $nome, $email, $telefone, $cpf);

        if (mysqli_stmt_execute($sql)) {
            $sucesso = "Funcionário atualizado com sucesso!";
        } else {
            $erro = "Erro ao atualizar: " . mysqli_error($conexao);
        }

        mysqli_close($conexao);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Funcionário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img src="itaularanja.png" class="banner" alt="Itaú">

    <main class="container">
        <div class="feedback-card">
            <?php if (isset($sucesso)): ?>
                <div class="feedback-icon sucesso">✓</div>
                <h2 class="feedback-titulo sucesso-txt"><?= $sucesso ?></h2>
                <p class="feedback-sub">Os dados foram atualizados no banco de dados.</p>
                <div class="feedback-acoes">
                    <a href="index.html" class="btn-primary">Voltar ao sistema</a>
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
