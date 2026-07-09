<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

<h1>Bem-vinda, Administradora!</h1>

<p>Login realizado com sucesso.</p>

<a href="login.php">Sair</a>

</body>
</html>