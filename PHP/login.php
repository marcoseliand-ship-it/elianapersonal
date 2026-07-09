<?php
session_start();
require 'conectar.php';

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';
$tipo = $_POST['tipo'] ?? '';

if ($email === '' || $senha === '' || $tipo === '') {
    echo 'Preencha todos os campos.';
    exit();
}

$conn->set_charset('utf8mb4');

$emailColumn = 'email';
$cols = $conn->query("SHOW COLUMNS FROM usuarios");
while ($col = $cols->fetch_assoc()) {
    if ($col['Field'] === 'e-mail' || $col['Field'] === 'e_mail') {
        $emailColumn = $col['Field'];
        break;
    }
}

$sql = 'SELECT id, nome, senha, tipo FROM usuarios WHERE `' . $emailColumn . '` = ? LIMIT 1';
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo 'Erro ao preparar a consulta: ' . htmlspecialchars($conn->error);
    exit();
}

$stmt->bind_param('s', $email);
if (!$stmt->execute()) {
    echo 'Erro ao executar a consulta: ' . htmlspecialchars($stmt->error);
    exit();
}

$resultado = $stmt->get_result();
if ($resultado === false) {
    echo 'Erro ao buscar os resultados: ' . htmlspecialchars($stmt->error);
    exit();
}

if ($resultado->num_rows == 1) {
    $usuario = $resultado->fetch_assoc();
    $senhaBanco = $usuario['senha'] ?? '';
    $tipoBanco = $usuario['tipo'] ?? '';

    if ($tipo === $tipoBanco && (password_verify($senha, $senhaBanco) || $senha === $senhaBanco)) {
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['tipo'] = $tipoBanco;

        if ($tipoBanco == 'admin') {
            header('Location: ../HTML/dashboard.php');
            exit();
        }

        header('Location: ../HTML/agenda.php');
        exit();
    }

    echo 'Senha incorreta ou tipo de acesso inválido.';
} else {
    echo 'Usuário não encontrado.';
}

$stmt->close();
$conn->close();
?>