<?php
// admin/dashboard/index.php

session_start();

// Verifica se o usuário está logado e se é um administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] != 'admin') {
    header("Location: ../../admin/login/login_admin.php");
    exit();
}

echo "Bem-vindo, Administrador!";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <h1>Dashboard do Administrador</h1>
    <nav>
        <ul>
            <li><a href="listar_animais.php">Listar Animais</a></li>
            <li><a href="listar_consulta.php">Consultas</a></li>
        
       </ul>
    </nav>
</body>
</html>