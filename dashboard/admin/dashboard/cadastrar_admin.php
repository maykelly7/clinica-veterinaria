<?php


session_start();



require_once '../../../classes/usuario.php';

$usuario = new Usuario();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar_admin'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = 'admin'; 

    if ($usuario->cadastrar($nome, $email, $senha, $tipo)) {
        echo "Administrador cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar administrador.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Administrador</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <h1>Cadastrar Administrador</h1>
    <form method="POST">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit" name="cadastrar_admin">Cadastrar</button>
    </form>
    <p><a href="../../../index.php">Voltar ao Dashboard</a></p>
</body>
</html>