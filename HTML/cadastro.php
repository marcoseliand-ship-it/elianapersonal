<?php
$sucesso = isset($_GET['sucesso']) && $_GET['sucesso'] === '1';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Aluno</title>

    <link rel="stylesheet" href="../CSS/cadastro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Criar Conta</h2>

            <?php if ($sucesso): ?>
                <p style="color:#2e7d32; margin-bottom:12px; font-weight:600;">Conta criada com sucesso! Você já pode entrar no sistema.</p>
            <?php endif; ?>

            <form id="formCadastro" action="../PHP/cadastrar.php" method="POST">
                <input type="text" name="nome" id="nome" placeholder="Nome completo">
                <input type="email" name="email" id="email" placeholder="E-mail">
                <input type="text" name="telefone" id="telefone" placeholder="Telefone">
                <input type="password" name="senha" id="senha" placeholder="Senha">
                <input type="password" name="confirmar_senha" id="confirmar_senha" placeholder="Confirmar senha">

                <button>Cadastrar</button>

                <p id="erro"></p>
                <a href="login.php">Já tenho uma conta</a>
            </form>
        </div>
    </div>

    <script src="../JS/cadastro.js"></script>
</body>
</html>