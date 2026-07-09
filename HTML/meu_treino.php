<?php
session_start();
require '../PHP/conectar.php';

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$alunoId = (int)$_SESSION['id'];
$treinos = $conn->query("SELECT * FROM treinos WHERE aluno_id = $alunoId ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Meu treino</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form input, form textarea, form button { display: block; width: 100%; margin-bottom: 10px; padding: 8px; }
        button { background: #2563eb; color: white; border: none; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { border-bottom: 1px solid #ddd; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Meu treino</h1>
    <p><a href="agenda.php">Voltar</a> | <a href="logout.php">Sair</a></p>

    <h3>Novo treino</h3>
    <form action="../PHP/salvar_treino.php" method="POST">
        <input type="text" name="nome" placeholder="Nome do treino" required>
        <textarea name="descricao" placeholder="Descrição do treino"></textarea>
        <button type="submit">Salvar treino</button>
    </form>

    <h3>Treinos cadastrados</h3>
    <table>
        <thead>
            <tr><th>Nome</th><th>Descrição</th></tr>
        </thead>
        <tbody>
            <?php if ($treinos->num_rows > 0): ?>
                <?php while ($treino = $treinos->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($treino['nome']); ?></td>
                        <td><?php echo htmlspecialchars($treino['descricao'] ?? ''); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="2">Nenhum treino cadastrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>