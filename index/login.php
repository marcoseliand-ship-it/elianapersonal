<?php
$sucesso = isset($_GET['sucesso']) && $_GET['sucesso'] === '1';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Eliana Dantas Personal</title>

    <a href="index.php" class="voltar">← Voltar para o início</a>
    <link rel="stylesheet" href="../CSS/login.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="background"></div>

    <div class="container">
        <div class="card">
            <h2>Bem-vindo!</h2>
            <p>Faça login para acessar sua agenda.</p>

            <?php if ($sucesso): ?>
                <p style="color:#2e7d32; margin-bottom:12px; font-weight:600;">Conta criada com sucesso! Faça login para continuar.</p>
            <?php endif; ?>

            <form id="formLogin" action="../PHP/login.php" method="POST">
                <div class="input-box">
                    <i class="fa fa-envelope"></i>
                    <input type="email" name="email" id="email" placeholder="Seu e-mail">
                </div>

                <div class="input-box">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="senha" id="senha" placeholder="Senha">
                    <span id="mostrarSenha"><i class="fa fa-eye"></i></span>
                </div>

                <select name="tipo" id="tipo">
                    <option value="">Selecione o acesso</option>
                    <option value="aluno">Aluno</option>
                    <option value="admin">Administrador</option>
                </select>

                <button>Entrar</button>

                <div class="links">
                    <a href="recuperar_senha.php" id="linkRecuperarSenha">Esqueci minha senha</a>
                    <a href="cadastro.php">Criar conta</a>
                </div>

                <p id="erro"></p>
            </form>
        </div>
    </div>

    <script src="../JS/login.js"></script>
</body>
</html>