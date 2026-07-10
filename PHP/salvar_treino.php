<?php
session_start();
require 'conectar.php';

if (!isset($_SESSION['id'])) {
    header('Location: ../index/login.php');
    exit();
}

$alunoId = (int)$_SESSION['id'];
$nome = trim($_POST['nome'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');

if ($nome === '') {
    die('Informe o nome do treino.');
}

$sql = "INSERT INTO treinos (aluno_id, nome, descricao) VALUES ($alunoId, '$nome', '$descricao')";
if ($conn->query($sql)) {
    header('Location: ../index/meu_treino.php');
    exit();
}

echo 'Erro ao salvar treino: ' . $conn->error;
