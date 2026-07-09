<?php
require 'conectar.php';

$email = trim($_POST['email'] ?? '');
$novaSenha = $_POST['nova_senha'] ?? '';
$confirmarSenha = $_POST['confirmar_senha'] ?? '';

if ($email === '' || $novaSenha === '' || $confirmarSenha === '') {
    header('Location: ../index/recuperar_senha.php?erro=1&msg=' . urlencode('Preencha todos os campos.'));
    exit();
}

if (strlen($novaSenha) < 6) {
    header('Location: ../index/recuperar_senha.php?erro=1&msg=' . urlencode('A nova senha deve ter no mínimo 6 caracteres.'));
    exit();
}

if ($novaSenha !== $confirmarSenha) {
    header('Location: ../index/recuperar_senha.php?erro=1&msg=' . urlencode('As senhas não coincidem.'));
    exit();
}

$conn->set_charset('utf8mb4');

$emailColumn = 'email';
$cols = $conn->query('SHOW COLUMNS FROM usuarios');
while ($col = $cols->fetch_assoc()) {
    if ($col['Field'] === 'e-mail' || $col['Field'] === 'e_mail') {
        $emailColumn = $col['Field'];
        break;
    }
}

$sql = 'SELECT id FROM usuarios WHERE `' . $emailColumn . '` = ? LIMIT 1';
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    header('Location: ../index/recuperar_senha.php?erro=1&msg=' . urlencode('Erro ao preparar a consulta.'));
    exit();
}

$stmt->bind_param('s', $email);
if (!$stmt->execute()) {
    header('Location: ../index/recuperar_senha.php?erro=1&msg=' . urlencode('Erro ao executar a consulta.'));
    exit();
}

$resultado = $stmt->get_result();
if ($resultado === false || $resultado->num_rows !== 1) {
    header('Location: ../index/recuperar_senha.php?erro=1&msg=' . urlencode('E-mail não encontrado.'));
    exit();
}

$senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
$updateSql = 'UPDATE usuarios SET senha = ? WHERE `' . $emailColumn . '` = ?';
$updateStmt = $conn->prepare($updateSql);
$updateStmt->bind_param('ss', $senhaHash, $email);

if (!$updateStmt->execute()) {
    header('Location: ../index/recuperar_senha.php?erro=1&msg=' . urlencode('Não foi possível atualizar a senha.'));
    exit();
}

$updateStmt->close();
$stmt->close();
$conn->close();

header('Location: ../index/login.php?sucesso=1');
exit();
