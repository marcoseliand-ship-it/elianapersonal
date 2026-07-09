<?php
session_start();
require '../PHP/conectar.php';

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$totalAlunos = $conn->query('SELECT COUNT(*) AS total FROM alunos')->fetch_assoc()['total'];
$totalAgendamentos = $conn->query('SELECT COUNT(*) AS total FROM agendamentos')->fetch_assoc()['total'];
$ultimosAlunos = $conn->query('SELECT id, nome, plano, status FROM alunos ORDER BY id DESC LIMIT 10');
$proximosAgendamentos = $conn->query('SELECT aluno_nome, data, horario FROM agendamentos ORDER BY data, horario LIMIT 5');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Eliana Dantas Personal</title>
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; margin: 0; background: #f5f7fb; }
        .container { display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background: #111827; color: white; padding: 24px 16px; }
        .content { flex: 1; padding: 24px; }
        .cards { display: grid; grid-template-columns: repeat(2, minmax(220px, 1fr)); gap: 16px; margin-bottom: 20px; }
        .card, .painel > div, .ultimos { background: white; border-radius: 14px; padding: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.06); }
        .painel { display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 16px; margin-bottom: 20px; }
        form input, form select, form textarea, form button { width: 100%; padding: 10px; margin-bottom: 10px; border-radius: 8px; border: 1px solid #d1d5db; }
        form button { background: #2563eb; color: white; border: none; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border-bottom: 1px solid #e5e7eb; text-align: left; }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo"><h2>💪 Eliana Personal</h2></div>
            <nav>
                <ul>
                    <li class="active"><a href="#"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                    <li><a href="agenda.php"><i class="fa-solid fa-calendar-days"></i> Agenda</a></li>
                    <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
                </ul>
            </nav>
        </aside>

        <main class="content">
            <header class="topbar">
                <div>
                    <h1>Dashboard</h1>
                    <p>Bem-vinda, <?php echo htmlspecialchars($_SESSION['nome']); ?> 👋</p>
                </div>
            </header>

            <section class="cards">
                <div class="card">
                    <i class="fa-solid fa-users"></i>
                    <h2><?php echo $totalAlunos; ?></h2>
                    <span>Alunos</span>
                </div>
                <div class="card">
                    <i class="fa-solid fa-calendar-check"></i>
                    <h2><?php echo $totalAgendamentos; ?></h2>
                    <span>Agendamentos</span>
                </div>
            </section>

            <section class="painel">
                <div class="grafico">
                    <h3>Cadastrar novo aluno</h3>
                    <form action="../PHP/salvar_aluno.php" method="POST">
                        <input type="text" name="nome" placeholder="Nome do aluno" required>
                        <input type="email" name="email" placeholder="E-mail">
                        <input type="text" name="telefone" placeholder="Telefone">
                        <select name="plano">
                            <option value="Mensal">Mensal</option>
                            <option value="Trimestral">Trimestral</option>
                            <option value="Premium">Premium</option>
                        </select>
                        <select name="status">
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                        </select>
                        <button type="submit">Salvar aluno</button>
                    </form>
                </div>

                <div class="agenda">
                    <h3>Próximos agendamentos</h3>
                    <ul>
                        <?php if ($proximosAgendamentos->num_rows > 0): ?>
                            <?php while ($item = $proximosAgendamentos->fetch_assoc()): ?>
                                <li><?php echo htmlspecialchars($item['data']); ?> às <?php echo htmlspecialchars($item['horario']); ?> — <?php echo htmlspecialchars($item['aluno_nome']); ?></li>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <li>Nenhum agendamento cadastrado.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </section>

            <section class="ultimos">
                <h3>Últimos alunos</h3>
                <table>
                    <thead>
                        <tr><th>Nome</th><th>Plano</th><th>Status</th><th>Ações</th></tr>
                    </thead>
                    <tbody>
                        <?php if ($ultimosAlunos->num_rows > 0): ?>
                            <?php while ($aluno = $ultimosAlunos->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($aluno['nome']); ?></td>
                                    <td><?php echo htmlspecialchars($aluno['plano']); ?></td>
                                    <td><?php echo htmlspecialchars($aluno['status']); ?></td>
                                    <td>
                                        <a href="editar_aluno.php?id=<?php echo $aluno['id']; ?>">Editar</a> |
                                        <a href="../PHP/excluir_aluno.php?id=<?php echo $aluno['id']; ?>" onclick="return confirm('Excluir este aluno?')">Excluir</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="3">Nenhum aluno cadastrado ainda.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>