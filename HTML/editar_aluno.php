<?php
session_start();
require '../PHP/conectar.php';

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$id = (int)($_GET['id'] ?? 0);
$aluno = null;
if ($id > 0) {
    $resultado = $conn->query("SELECT * FROM alunos WHERE id = $id");
    if ($resultado && $resultado->num_rows > 0) {
        $aluno = $resultado->fetch_assoc();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $plano = trim($_POST['plano'] ?? 'Mensal');
    $status = trim($_POST['status'] ?? 'Ativo');

    if ($nome !== '') {
        $conn->query("UPDATE alunos SET nome = '$nome', email = '$email', telefone = '$telefone', plano = '$plano', status = '$status' WHERE id = $id");
        header('Location: dashboard.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar aluno</title>
    <style>body{font-family:Arial,sans-serif;margin:20px;} form input,form select,form button{display:block;width:100%;margin-bottom:10px;padding:8px;}</style>
</head>
<body>
    <h1>Editar aluno</h1>
    <?php if ($aluno): ?>
        <form method="POST">
            <input type="text" name="nome" value="<?php echo htmlspecialchars($aluno['nome']); ?>" required>
            <input type="email" name="email" value="<?php echo htmlspecialchars($aluno['email'] ?? ''); ?>">
            <input type="text" name="telefone" value="<?php echo htmlspecialchars($aluno['telefone'] ?? ''); ?>">
            <select name="plano">
                <option value="Mensal" <?php echo $aluno['plano'] === 'Mensal' ? 'selected' : ''; ?>>Mensal</option>
                <option value="Trimestral" <?php echo $aluno['plano'] === 'Trimestral' ? 'selected' : ''; ?>>Trimestral</option>
                <option value="Premium" <?php echo $aluno['plano'] === 'Premium' ? 'selected' : ''; ?>>Premium</option>
            </select>
            <select name="status">
                <option value="Ativo" <?php echo $aluno['status'] === 'Ativo' ? 'selected' : ''; ?>>Ativo</option>
                <option value="Inativo" <?php echo $aluno['status'] === 'Inativo' ? 'selected' : ''; ?>>Inativo</option>
            </select>
            <button type="submit">Salvar</button>
        </form>
    <?php else: ?>
        <p>Aluno não encontrado.</p>
    <?php endif; ?>
</body>
</html>