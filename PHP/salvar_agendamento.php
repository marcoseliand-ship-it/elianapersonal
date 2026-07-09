<?php
require 'conectar.php';

$alunoNome = trim($_POST['aluno_nome'] ?? '');
$data = trim($_POST['data'] ?? '');
$horario = trim($_POST['horario'] ?? '');
$observacao = trim($_POST['observacao'] ?? '');

if ($alunoNome === '' || $data === '' || $horario === '') {
    die('Preencha o nome, a data e o horário.');
}

$sql = "INSERT INTO agendamentos (aluno_nome, data, horario, observacao) VALUES ('$alunoNome', '$data', '$horario', '$observacao')";
if ($conn->query($sql)) {
    header('Location: ../HTML/agenda.php');
    exit();
}

echo 'Erro ao salvar agendamento: ' . $conn->error;
?>