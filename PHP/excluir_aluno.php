<?php
require 'conectar.php';
$id = (int)($_GET['id'] ?? 0);

if ($id > 0 && $conn->query("DELETE FROM alunos WHERE id = $id")) {
    header('Location: ../HTML/dashboard.php');
    exit();
}

echo 'Erro ao excluir aluno.';
