<?php
include 'conexao.php';

// Busca todos os funcionários em ordem alfabética
$sql = "SELECT * FROM clientes ORDER BY nome ASC";
$resultado = mysqli_query($conexao, $sql);
$total = mysqli_num_rows($resultado);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Funcionários</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <main class="container">

        <div class="lista-header">
            <h2 class="lista-titulo">Lista de Funcionários</h2>
            <span class="lista-total"><?= $total ?> funcionário(s)</span>
        </div>

        <?php if ($total > 0): ?>
            <div class="tabela-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>E-mail</th>
                            <th>Cidade</th>
                            <th>Cargo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($linha = mysqli_fetch_assoc($resultado)): ?>
                        <tr>
                            <td><?= $linha['nome'] ?></td>
                            <td class="mono"><?= $linha['cpf'] ?></td>
                            <td><?= $linha['email'] ?></td>
                            <td><?= $linha['cidade'] ?></td>
                            <td><?= ucwords(str_replace('_', ' ', $linha['profissao'])) ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>
            <p style="text-align:center; color:#666; padding:40px 0;">Nenhum funcionário cadastrado.</p>
        <?php endif; ?>

        <?php mysqli_close($conexao); ?>

        <div class="lista-acoes">
            <button onclick="window.history.back()" class="btn-secundario">← Voltar</button>
        </div>

    </main>

    <footer class="rodape">
        <p>Gerenciamento de Funcionários &mdash; Itaú Unibanco</p>
    </footer>
</body>
</html>
