<?php
session_start();
require '../PHP/conectar.php';

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$id = (int)($_GET['id'] ?? 0);
$item = null;
if ($id > 0) {
    $resultado = $conn->query("SELECT * FROM agendamentos WHERE id = $id");
    if ($resultado && $resultado->num_rows > 0) {
        $item = $resultado->fetch_assoc();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $alunoNome = trim($_POST['aluno_nome'] ?? '');
    $data = trim($_POST['data'] ?? '');
    $horario = trim($_POST['horario'] ?? '');
    $observacao = trim($_POST['observacao'] ?? '');

    if ($alunoNome !== '' && $data !== '' && $horario !== '') {
        $conn->query("UPDATE agendamentos SET aluno_nome = '$alunoNome', data = '$data', horario = '$horario', observacao = '$observacao' WHERE id = $id");
        header('Location: agenda.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar agendamento</title>
    <style>body{font-family:Arial,sans-serif;margin:20px;} form input,form textarea,form button{display:block;width:100%;margin-bottom:10px;padding:8px;}</style>
</head>
<body>
    <h1>Editar agendamento</h1>
    <?php if ($item): ?>
        <form method="POST">
            <input type="text" name="aluno_nome" value="<?php echo htmlspecialchars($item['aluno_nome']); ?>" required>
            <input type="date" name="data" value="<?php echo htmlspecialchars($item['data']); ?>" required>
            <input type="time" name="horario" value="<?php echo htmlspecialchars($item['horario']); ?>" required>
            <textarea name="observacao"><?php echo htmlspecialchars($item['observacao'] ?? ''); ?></textarea>
            <button type="submit">Salvar</button>
        </form>
    <?php else: ?>
        <p>Agendamento não encontrado.</p>
    <?php endif; ?>
</body>
</html>