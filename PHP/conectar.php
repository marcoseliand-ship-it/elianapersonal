<?php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'elianapersonal';

$conn = new mysqli($host, $usuario, $senha);

if ($conn->connect_error) {
    die('Erro na conexão com o MySQL: ' . $conn->connect_error);
}

$conn->set_charset('utf8mb4');

if (!$conn->query("CREATE DATABASE IF NOT EXISTS `$banco` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci")) {
    die('Erro ao criar o banco: ' . $conn->error);
}

if (!$conn->select_db($banco)) {
    die('Erro ao selecionar o banco: ' . $conn->error);
}

$conn->query("CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefone VARCHAR(20) DEFAULT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo VARCHAR(20) NOT NULL DEFAULT 'aluno',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$conn->query("CREATE TABLE IF NOT EXISTS alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) DEFAULT NULL,
    telefone VARCHAR(20) DEFAULT NULL,
    plano VARCHAR(50) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'Ativo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$conn->query("CREATE TABLE IF NOT EXISTS agendamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aluno_nome VARCHAR(100) NOT NULL,
    data DATE NOT NULL,
    horario TIME NOT NULL,
    observacao TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$conn->query("CREATE TABLE IF NOT EXISTS treinos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aluno_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$colsResult = $conn->query('SHOW COLUMNS FROM usuarios');
$colunas = [];
while ($col = $colsResult->fetch_assoc()) {
    $colunas[] = $col['Field'];
}

$emailColumn = 'email';
if (!in_array('email', $colunas, true)) {
    if (in_array('e-mail', $colunas, true)) {
        $emailColumn = 'e-mail';
    } elseif (in_array('e_mail', $colunas, true)) {
        $emailColumn = 'e_mail';
    }
}

$verificaAdmin = $conn->query("SELECT id FROM usuarios WHERE `$emailColumn` = 'admin@elianapersonal.com' LIMIT 1");
if ($verificaAdmin && $verificaAdmin->num_rows === 0) {
    $senhaAdmin = password_hash('123456', PASSWORD_DEFAULT);
    $nomeAdmin = 'Administrador';
    $emailAdmin = 'admin@elianapersonal.com';
    $telefoneAdmin = '';
    $tipoAdmin = 'admin';

    $sqlInsertAdmin = "INSERT INTO usuarios (nome, `$emailColumn`, telefone, senha, tipo) VALUES ('$nomeAdmin', '$emailAdmin', '$telefoneAdmin', '$senhaAdmin', '$tipoAdmin')";
    $conn->query($sqlInsertAdmin);
}
?>