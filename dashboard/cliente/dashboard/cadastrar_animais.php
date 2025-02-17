<?php
// cliente/dashboard/cadastrar_animal.php

session_start();

// Verifica se o usuário está logado e se é um cliente
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] != 'cliente') {
    header("Location: ../../cliente/login/login_cliente.php");
    exit();
}

require_once '../../classes/Animal.php';

$animal = new Animal();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar_animal'])) {
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $raca = $_POST['raca'];
    $idade = $_POST['idade'];
    $dono_nome = $_SESSION['usuario']['nome']; // Nome do dono é o nome do cliente logado
    $telefone = $_POST['telefone'];

    if ($animal->cadastrar($nome, $especie, $raca, $idade, $dono_nome, $telefone)) {
        echo "Animal cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar animal.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Animal</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <h1>Cadastrar Animal</h1>
    <form method="POST">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="text" name="especie" placeholder="Espécie" required>
        <input type="text" name="raca" placeholder="Raça">
        <input type="number" name="idade" placeholder="Idade">
        <input type="text" name="telefone" placeholder="Telefone" required>
        <button type="submit" name="cadastrar_animal">Cadastrar</button>
    </form>
    <a href="index.php">Voltar ao Dashboard</a>
</body>
</html>