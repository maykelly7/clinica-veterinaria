<?php
// cliente/dashboard/index.php

session_start();

// Verifica se o usuário está logado e se é um cliente
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] != 'cliente') {
    header("Location: ../../cliente/login/login_cliente.php");
    exit();
}

echo "Bem-vindo, " . $_SESSION['usuario']['nome'] . "!";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Cliente</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <h1>Dashboard do Cliente</h1>
    <nav>
        <ul>
            <li><a href="cadastrar_animais.php">Cadastrar Animal</a></li>
            <li><a href="agendar_consulta.php">Agendar Consulta</a></li>
            <li><a href="listar_animais.php">Listar Animais</a></li>
        
        </ul>
    </nav>
</body>
</html>