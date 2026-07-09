<?php
$erro = isset($_GET['erro']) && $_GET['erro'] === '1';
$mensagem = '';
if ($erro) {
    $mensagem = isset($_GET['msg']) ? urldecode($_GET['msg']) : 'Não foi possível redefinir a senha.';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recuperar senha | Eliana Dantas Personal</title>

    <a href="login.php" class="voltar">← Voltar para o login</a>
    <link rel="stylesheet" href="../CSS/login.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="background"></div>

    <div class="container">
        <div class="card">
            <h2>Recuperar senha</h2>
            <p>Informe o e-mail cadastrado e defina uma nova senha.</p>

            <?php if ($erro): ?>
                <p style="color:#ffb3b3; margin-bottom:12px; font-weight:600;"><?= htmlspecialchars($mensagem) ?></p>
            <?php endif; ?>

            <form action="../PHP/recuperar_senha.php" method="POST">
                <div class="input-box">
                    <i class="fa fa-envelope"></i>
                    <input type="email" name="email" id="email" placeholder="Seu e-mail" required>
                </div>

                <div class="input-box">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="nova_senha" id="nova_senha" placeholder="Nova senha" required>
                </div>

                <div class="input-box">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="confirmar_senha" id="confirmar_senha" placeholder="Confirmar nova senha" required>
                </div>

                <button>Redefinir senha</button>
            </form>
        </div>
    </div>
</body>
</html>
