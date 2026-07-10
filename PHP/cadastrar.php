<?php
require 'conectar.php';

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$senha = $_POST['senha'] ?? '';
$confirmarSenha = $_POST['confirmar_senha'] ?? '';

if ($nome === '' || $email === '' || $telefone === '' || $senha === '' || $confirmarSenha === '') {
    echo 'Preencha todos os campos.';
    exit();
}

if ($senha !== $confirmarSenha) {
    echo 'As senhas não coincidem.';
    exit();
}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$emailColumn = 'email';
$cols = $conn->query('SHOW COLUMNS FROM usuarios');
if ($cols) {
    while ($col = $cols->fetch_assoc()) {
        if ($col['Field'] === 'email' || $col['Field'] === 'e-mail' || $col['Field'] === 'e_mail') {
            $emailColumn = $col['Field'];
            break;
        }
    }
}

$nome = $conn->real_escape_string($nome);
$email = $conn->real_escape_string($email);
$telefone = $conn->real_escape_string($telefone);
$senhaHash = $conn->real_escape_string($senhaHash);
$tipo = 'aluno';

$verifica = $conn->query("SELECT id FROM usuarios WHERE `$emailColumn` = '$email' LIMIT 1");
if ($verifica && $verifica->num_rows > 0) {
    die('Este e-mail já está cadastrado.');
}

$sql = "INSERT INTO usuarios (nome, `$emailColumn`, telefone, senha, tipo) VALUES ('$nome', '$email', '$telefone', '$senhaHash', '$tipo')";

if ($conn->query($sql)) {
    session_start();
    $_SESSION['id'] = $conn->insert_id;
    $_SESSION['nome'] = $nome;
    $_SESSION['tipo'] = $tipo;
    header('Location: ../index/login.php?sucesso=1');
    exit();
}

echo 'Erro ao cadastrar: ' . $conn->error;

$conn->close();
?>