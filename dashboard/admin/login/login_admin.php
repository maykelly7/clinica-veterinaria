<?php
// admin/login/login_admin.php

session_start();

require_once '../../../classes/usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $usuario = new Usuario();
    $dadosUsuario = $usuario->login($email, $senha);

    if ($dadosUsuario) {
        // Armazena os dados do usuário na sessão
        $_SESSION['usuario'] = $dadosUsuario;

        // Redireciona para o dashboard do administrador
        header("Location: ../dashboard/index_admin.php");
        exit(); // Encerra o script após o redirecionamento
    } else {
        // Exibe uma mensagem de erro se o login falhar
        echo "Email ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login Administrador</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <h1>Login Administrador</h1>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
    <p>Não tem uma conta? <a href="../cadastro/cadastrar_admin.php">Cadastre-se</a></p>
</body>
</html>