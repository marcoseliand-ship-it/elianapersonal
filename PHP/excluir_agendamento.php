<?php
require 'conectar.php';
$id = (int)($_GET['id'] ?? 0);

if ($id > 0 && $conn->query("DELETE FROM agendamentos WHERE id = $id")) {
    header('Location: ../HTML/agenda.php');
    exit();
}

echo 'Erro ao excluir agendamento.';
