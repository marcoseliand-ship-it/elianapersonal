<?php
require 'conectar.php';

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$plano = trim($_POST['plano'] ?? 'Mensal');
$status = trim($_POST['status'] ?? 'Ativo');

if ($nome === '') {
    die('Nome do aluno é obrigatório.');
}

$sql = "INSERT INTO alunos (nome, email, telefone, plano, status) VALUES ('$nome', '$email', '$telefone', '$plano', '$status')";
if ($conn->query($sql)) {
    header('Location: ../HTML/dashboard.php');
    exit();
}

echo 'Erro ao salvar aluno: ' . $conn->error;
?>