<?php
include 'conexao.php';

if (isset($_POST['cpf'])) {

    $cpf = $_POST['cpf'];

    if (empty($cpf)) {
        $erro = "Informe o CPF para excluir!";
    } else {
        // Deleta o funcionário usando prepared statement
        $sql = mysqli_prepare($conexao, "DELETE FROM clientes WHERE cpf=?");
        mysqli_stmt_bind_param($sql, "s", $cpf);

        if (mysqli_stmt_execute($sql)) {
            if (mysqli_stmt_affected_rows($sql) > 0) {
                $sucesso = "Funcionário excluído com sucesso!";
            } else {
                $erro = "Nenhum funcionário encontrado com esse CPF.";
            }
        } else {
            $erro = "Erro ao excluir: " . mysqli_error($conexao);
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
    <title>Excluir Funcionário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img src="itaularanja.png" class="banner" alt="Itaú">

    <main class="container">
        <div class="feedback-card">
            <?php if (isset($sucesso)): ?>
                <div class="feedback-icon sucesso">✓</div>
                <h2 class="feedback-titulo sucesso-txt"><?= $sucesso ?></h2>
                <p class="feedback-sub">O registro foi removido do banco de dados.</p>
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
