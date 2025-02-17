<?php
// editar_animal.php

require_once 'classes/Animal.php';

$animal = new Animal();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar_animal'])) {
    $animal->editar($_POST['id'], $_POST['nome'], $_POST['especie'], $_POST['raca'], $_POST['idade'], $_POST['dono_nome'], $_POST['telefone']);
    header("Location: index.php");
}

$id = $_GET['id'];
$animais = $animal->listar(['id' => $id]);
$animal_data = $animais->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Animal</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Editar Animal</h1>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $animal_data['id'] ?>">
        <input type="text" name="nome" placeholder="Nome" value="<?= $animal_data['nome'] ?>" required>
        <input type="text" name="especie" placeholder="Espécie" value="<?= $animal_data['especie'] ?>" required>
        <input type="text" name="raca" placeholder="Raça" value="<?= $animal_data['raca'] ?>">
        <input type="number" name="idade" placeholder="Idade" value="<?= $animal_data['idade'] ?>">
        <input type="text" name="dono_nome" placeholder="Nome do Dono" value="<?= $animal_data['dono_nome'] ?>" required>
        <input type="text" name="telefone" placeholder="Telefone" value="<?= $animal_data['telefone'] ?>">
        <button type="submit" name="editar_animal">Salvar</button>
    </form>
</body>
</html>