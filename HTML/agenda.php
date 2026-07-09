<?php
session_start();
require '../PHP/conectar.php';

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$agendamentos = $conn->query('SELECT * FROM agendamentos ORDER BY data, horario');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agenda | Eliana Personal</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form input, form textarea, form button { display: block; width: 100%; margin-bottom: 10px; padding: 8px; }
        button { background: #2563eb; color: white; border: none; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { border-bottom: 1px solid #ddd; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Agenda</h1>
    <p><a href="dashboard.php">Voltar ao dashboard</a> | <a href="meu_treino.php">Meu treino</a> | <a href="logout.php">Sair</a></p>

    <h3>Novo agendamento</h3>
    <form action="../PHP/salvar_agendamento.php" method="POST">
        <input type="text" name="aluno_nome" placeholder="Nome do aluno" required>
        <input type="date" name="data" required>
        <input type="time" name="horario" required>
        <textarea name="observacao" placeholder="Observação"></textarea>
        <button type="submit">Salvar agendamento</button>
    </form>

    <h3>Agendamentos cadastrados</h3>
    <table>
        <thead>
            <tr><th>Aluno</th><th>Data</th><th>Horário</th><th>Observação</th><th>Ações</th></tr>
        </thead>
        <tbody>
            <?php if ($agendamentos->num_rows > 0): ?>
                <?php while ($item = $agendamentos->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['aluno_nome']); ?></td>
                        <td><?php echo htmlspecialchars($item['data']); ?></td>
                        <td><?php echo htmlspecialchars($item['horario']); ?></td>
                        <td><?php echo htmlspecialchars($item['observacao'] ?? ''); ?></td>
                        <td>
                            <a href="editar_agendamento.php?id=<?php echo $item['id']; ?>">Editar</a> |
                            <a href="../PHP/excluir_agendamento.php?id=<?php echo $item['id']; ?>" onclick="return confirm('Excluir este agendamento?')">Excluir</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4">Nenhum agendamento cadastrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>