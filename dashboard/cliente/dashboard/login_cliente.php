<?php
// cliente/login/login_cliente.php

session_start();

require_once '../../../classes/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $usuario = new Usuario();
    $dadosUsuario = $usuario->login($email, $senha);

    if ($dadosUsuario && $dadosUsuario['tipo'] == 'cliente') {
        $_SESSION['usuario'] = $dadosUsuario; // Armazena os dados do usuário na sessão
        header("Location: ../dashboard/deahboard_cliente.php"); // Redireciona para o dashboard do cliente
        exit();
    } else {
        echo "Email ou senha incorretos, ou você não é um cliente!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login Cliente</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <h1>Login Cliente</h1>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
    <p>Não tem uma conta? <a href="../cadastro/cadastrar_cliente.php">Cadastre-se</a></p>
</body>
</html>